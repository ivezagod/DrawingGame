import './bootstrap';
import axios from 'axios';

const canvas = document.getElementById('drawing-board');
const toolbar = document.getElementById('toolbar');
const eraserButton = document.getElementById('eraser');
const clearButton = document.getElementById('clear');
const saveForm = document.getElementById('save-form');
const canvasImageDataInput = document.getElementById('canvas-image-data');
const lineWidthInput = document.getElementById('lineWidth');
const lineWidthValue = document.getElementById('lineWidthValue');

const ctx = canvas.getContext('2d');
const canvasRect = canvas.getBoundingClientRect();

canvas.width = canvasRect.width;
canvas.height = canvasRect.height;

let isPainting = false;
let lineWidth = 5;
let eraserMode = false;
let coordinates = [];

toolbar.addEventListener('click', e => {
    if (e.target.id === 'eraser') {
        eraserMode = !eraserMode;
        if (eraserMode) {
            eraserButton.classList.add('active');
            ctx.strokeStyle = '#ffffff';
        } else {
            eraserButton.classList.remove('active');
            ctx.strokeStyle = document.getElementById('stroke').value;
        }
    }
});

toolbar.addEventListener('change', e => {
    if (e.target.id === 'stroke' && !eraserMode) {
        ctx.strokeStyle = e.target.value;
    }
});

lineWidthInput.addEventListener('input', (e) => {
    lineWidth = parseInt(e.target.value);
    lineWidthValue.textContent = lineWidth;
});

const draw = (e) => {
    if (!isPainting) {
        return;
    }

    const x = e.clientX - canvasRect.left;
    const y = e.clientY - canvasRect.top;

    ctx.lineWidth = lineWidth;
    ctx.lineCap = 'round';

    ctx.lineTo(x, y);
    ctx.stroke();

    coordinates.push({ x, y });

};

canvas.addEventListener('mousedown', (e) => {
    isPainting = true;
    ctx.beginPath();
    ctx.moveTo(e.clientX - canvasRect.left, e.clientY - canvasRect.top);
});

canvas.addEventListener('mouseup', () => {
    isPainting = false;
    const url = window.location.href.split('/').pop();
    sendDrawingCoordinates(url, coordinates);
    saveDrawingData(url, coordinates, lineWidth);
    coordinates = [];
});

canvas.addEventListener('mousemove', draw);

const saveDrawingData = (url, data, lineWidth) => {
    console.log('Saving drawing data for URL:', url);
    const existingData = loadDrawingData(url);
    const newData = { coordinates: [], lineWidth: lineWidth };

    if (existingData) {
        newData.coordinates = [...existingData.coordinates, ...data];
    } else {
        newData.coordinates = data;
    }

    localStorage.setItem(`drawingData_${url}`, JSON.stringify(newData));
};


const loadDrawingData = (url) => {
    const data = localStorage.getItem(`drawingData_${url}`);
    console.log('Loaded drawing data for URL:', url, data); // Debugging
    return data ? JSON.parse(data) : null;
};

const redrawCanvas = (url) => {
    const savedData = loadDrawingData(url);
    if (savedData) {

        ctx.clearRect(0, 0, canvas.width, canvas.height);


        ctx.lineWidth = savedData.lineWidth;
        savedData.coordinates.forEach(({ x, y }) => {
  
            ctx.lineTo(x, y);
            ctx.stroke();
        });
    }
};

window.addEventListener('load', () => {
    // Extract the URL from the current page
    const url = window.location.href.split('/').pop();
    // Redraw the canvas with saved drawing data for the current URL
    redrawCanvas(url);
});

let currentUrl = window.location.href.split('/').pop();

const sendDrawingCoordinates = async (currentUrl,coordinates) => {
    try {
        await axios.post('/drawing-coordinates', {
            url: currentUrl,
            coordinates: coordinates
        });
    } catch (error) {
        console.error('Error sending drawing coordinates:', error);
    }
};

Echo.channel(`drawing-channel.${currentUrl}`)
    .listen('\\App\\Events\\DrawingUpdated', (e) => {
        console.log(e);


        coordinates.push(e.coordinates)

        if (coordinates && Array.isArray(coordinates)) {
            coordinates.forEach(({ x, y }) => {
                draw({ clientX: x, clientY: y });
            });
        } else {
            console.error('Invalid or missing coordinates property in the event object');
        }
    });


saveForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const imageDataURL = canvas.toDataURL();
    canvasImageDataInput.value = imageDataURL;

    saveForm.submit();
});

clearButton.addEventListener('click', () => {
    const url = window.location.href.split('/').pop();
    // Clear the canvas and remove saved drawing data for the current URL
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    localStorage.removeItem(`drawingData_${url}`);
});









