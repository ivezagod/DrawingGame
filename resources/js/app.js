import './bootstrap';
import axios from 'axios';
import colors from "tailwindcss/colors.js";


const canvas = document.getElementById('drawing-board');
const toolbar = document.getElementById('toolbar');
const eraserButton = document.getElementById('eraser');
const clearButton = document.getElementById('clear');
const lineWidthInput = document.getElementById('lineWidth');
const lineWidthValue = document.getElementById('lineWidthValue');

const ctx = canvas.getContext('2d');
const canvasRect = canvas.getBoundingClientRect();


canvas.width = canvasRect.width;
canvas.height = canvasRect.height;

let isPainting = false;
let lineWidth = 5;
let color = 0;
let eraserMode = false;
let coordinates = [];
let currentPath = [];
let paths = [];

toolbar.addEventListener('click', e => {
    if (e.target.id === 'eraser') {
        eraserMode = !eraserMode;
        if (eraserMode) {
            eraserButton.classList.add('active');
            ctx.strokeStyle = '#ffffff';
        } else {
            eraserButton.classList.remove('active');
            ctx.strokeStyle = document.getElementById('stroke').value; // Restore previous color
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
toolbar.addEventListener('change', e => {
    if (e.target.id === 'stroke' && !eraserMode) {
        ctx.strokeStyle = e.target.value;
    }
});


const draw = (e) => {
    if (!isPainting) {
        return;
    }

    const x = e.clientX - canvasRect.left;
    const y = e.clientY - canvasRect.top;

    ctx.lineWidth = lineWidth;
    ctx.lineCap = 'round';
    color = ctx.strokeStyle;



    ctx.lineTo(x, y);
    ctx.stroke();

    coordinates.push({ x, y });
    currentPath.push({ x, y, color, lineWidth });

};

canvas.addEventListener('mousedown', (e) => {
    isPainting = true;
    ctx.beginPath();
    ctx.moveTo(e.clientX - canvasRect.left, e.clientY - canvasRect.top);
});

canvas.addEventListener('mouseup', () => {
    isPainting = false;
    const url = window.location.href.split('/').pop();
    sendDrawingCoordinates(url, coordinates, ctx.strokeStyle); // Pass current color
    saveDrawingData(url, coordinates, lineWidth, ctx.strokeStyle);
    coordinates = [];

    paths.push([...currentPath]);
    saveDrawingData(url);
    currentPath = [];
});



canvas.addEventListener('mousemove', draw);

const saveDrawingData = (url) => {
    console.log("Saving data:", paths);
    localStorage.setItem(`drawingData_${url}`, JSON.stringify(paths));
    console.log(`Drawing data saved for URL: ${url}`, paths);
};

const loadDrawingData = (url) => {
    const data = localStorage.getItem(`drawingData_${url}`);
    try {
        return data ? JSON.parse(data) : [];
    } catch (error) {
        console.error('Error parsing drawing data:', error);
        return [];
    }
};


const redrawCanvas = (url) => {
    console.log('redrawing canvas')
    const savedData = loadDrawingData(url);
    paths = savedData;
    if (savedData) {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        savedData.forEach(path => {
            console.log('loging path',path)
            ctx.beginPath();
            path.forEach(({ x, y, color, lineWidth }) => {


                ctx.lineTo(x, y);
                ctx.lineWidth = lineWidth;
                ctx.strokeStyle = color;
                ctx.stroke();

            });
            ctx.closePath();
        });

    }
};






let currentUrl = window.location.href.split('/').pop();

window.addEventListener('load', () => {
    redrawCanvas(currentUrl);
});

const sendDrawingCoordinates = async (currentUrl, coordinates, color) => {
    try {
        await axios.post('/api/drawing-coordinates', {
            url: currentUrl,
            coordinates: coordinates,
            color: color,
            lineWidth: lineWidth,
        });
    } catch (error) {
        console.error('Error sending drawing coordinates:', error);
    }
};


Echo.channel(`drawing-channel.${currentUrl}`)
    .listen('\\App\\Events\\DrawingUpdated', (e) => {
        console.log(e.coordinates);

        if (e.coordinates.length === 0) {

            ctx.clearRect(0, 0, canvas.width, canvas.height);
        } else {
            ctx.beginPath();


            e.coordinates.forEach(({ x, y, color }) => {
                ctx.lineTo(x, y);
                ctx.lineWidth = e.color;
                ctx.strokeStyle = e.lineWidth;
                console.log(ctx.strokeStyle, e.color)
                ctx.stroke();



            });

            ctx.closePath();
        }
    });






const downloadImage = async () => {
    const imageDataURL = canvas.toDataURL();
    try {
        const response = await axios.post('/api/download-image', {
            image: imageDataURL
        });

        const imageUrl = response.data.url;

        // Download the image
        const link = document.createElement('a');
        link.href = imageUrl;
        link.download = 'drawing.png';
        link.click();
    } catch (error) {
        console.error('Error downloading image:', error);
    }
};

const downloadImageButton = document.getElementById('download-image-btn');

if (downloadImageButton) {
    downloadImageButton.addEventListener('click', downloadImage);
}


clearButton.addEventListener('click', () => {
    const url = window.location.href.split('/').pop();


    ctx.clearRect(0, 0, canvas.width, canvas.height);


    localStorage.removeItem(`drawingData_${url}`);


    sendDrawingCoordinates(url, [], null);
});

