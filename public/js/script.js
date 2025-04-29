const canvases = [
    { id: 'scratchCanvas1', linkSelector: '.hidden-link1' },
    { id: 'scratchCanvas2', linkSelector: '.hidden-link2' },
    { id: 'scratchCanvas3', linkSelector: '.hidden-link3' },
    { id: 'scratchCanvas4', linkSelector: '.hidden-link4' }
];

canvases.forEach(({ id, linkSelector }) => {
    const canvas = document.getElementById(id);
    const ctx = canvas.getContext('2d');
    const hiddenImage = document.querySelector('.hidden-image');
    const hiddenLink = document.querySelector(linkSelector);

    canvas.width = canvas.offsetWidth;
    canvas.height = canvas.offsetHeight;

    ctx.fillStyle = '#82ae46';
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    ctx.textAlign = 'center';
    ctx.fillStyle = '#fff';
    ctx.font = 'bold 22px Arial';

    if (id === 'scratchCanvas1' || id === 'scratchCanvas2') {
        ctx.fillText('FRUIT', canvas.width / 2, canvas.height / 2 - 30);
        ctx.fillText('OR', canvas.width / 2, canvas.height / 2);
        ctx.fillText('VEGETABLE', canvas.width / 2, canvas.height / 2 + 30);
    } else if (id === 'scratchCanvas3' || id === 'scratchCanvas4') {
        ctx.fillText('JUICES', canvas.width / 2, canvas.height / 2 - 30);
        ctx.fillText('OR', canvas.width / 2, canvas.height / 2);
        ctx.fillText('DRIED', canvas.width / 2, canvas.height / 2 + 30);
    }

    ctx.font = 'bold 18px Arial';
    ctx.fillText('DISCOVER NOW!', canvas.width / 2, canvas.height / 2 + 60);

    let isScratching = false;

    // Mouse events
    canvas.addEventListener('mousedown', () => {
        isScratching = true;
    });

    canvas.addEventListener('mouseup', () => {
        isScratching = false;
        checkIfCleared(canvas, ctx, hiddenLink);
    });

    canvas.addEventListener('mousemove', (e) => {
        if (!isScratching) return;

        const rect = canvas.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        ctx.globalCompositeOperation = 'destination-out';
        ctx.beginPath();
        ctx.arc(x, y, 20, 0, Math.PI * 2, false);
        ctx.fill();
    });

    // Touch events
    canvas.addEventListener('touchstart', (e) => {
        isScratching = true;
        e.preventDefault(); // sprečava skrolovanje dok grebeš
    });

    canvas.addEventListener('touchend', (e) => {
        isScratching = false;
        checkIfCleared(canvas, ctx, hiddenLink);
        e.preventDefault();
    });

    canvas.addEventListener('touchmove', (e) => {
        if (!isScratching) return;

        const rect = canvas.getBoundingClientRect();
        const touch = e.touches[0]; // uzmi prvi prst
        const x = touch.clientX - rect.left;
        const y = touch.clientY - rect.top;

        ctx.globalCompositeOperation = 'destination-out';
        ctx.beginPath();
        ctx.arc(x, y, 20, 0, Math.PI * 2, false);
        ctx.fill();

        e.preventDefault(); // sprečava skrolovanje dok grebeš
    }, { passive: false });
});

function checkIfCleared(canvas, ctx, hiddenLink) {
    const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
    const pixels = imageData.data;
    let clearedPixels = 0;

    for (let i = 0; i < pixels.length; i += 4) {
        if (pixels[i + 3] === 0) {
            clearedPixels++;
        }
    }

    const clearedPercentage = (clearedPixels / (pixels.length / 4)) * 100;

    if (clearedPercentage > 75) {
        canvas.style.opacity = 0; 
        hiddenLink.classList.add('active'); 
    }
}

$(function () {
    const minPrice = 0;
    const maxPrice = 100000;

    $("#slider").slider({
        range: true,
        min: minPrice,
        max: maxPrice,
        values: [minPrice, maxPrice],
        slide: function (event, ui) {
            $("#min-price").text(ui.values[0]);
            $("#max-price").text(ui.values[1]);
        },
    });
});
