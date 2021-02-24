const canv = document.querySelector('#canv');
const ctx = canv.getContext('2d');
const penCol = document.querySelector('input[name="pencol"]');
const penwidth = document.querySelector('input[name="penwidth"]');
const rrbutton = document.querySelector('button[name="rrbutton"]');

ctx.strokeStyle = '#000000';
ctx.lineJoin = 'round';
ctx.lineCap = 'round';
ctx.lineWidth = 5;
let pen = {
    x:0,
    y:0,
    down:false
}

canv.addEventListener('mousedown', (event) => {
    pen.down = true;
    pen.x = event.offsetX;
    pen.y = event.offsetY;
    console.log(pen);
});

canv.addEventListener('mousemove', (event) => {
    if(!pen.down)
        return;

    ctx.lineWidth = penwidth.value;
    ctx.beginPath();
    ctx.strokeStyle = penCol.value;
    ctx.moveTo(pen.x, pen.y);
    ctx.lineTo(event.offsetX, event.offsetY);
    ctx.stroke();
    pen.x = event.offsetX;
    pen.y = event.offsetY;

});

canv.addEventListener('mouseup', stopDraw);
canv.addEventListener('mouseout', stopDraw);

rrbutton.addEventListener('click', () => {
    ctx.fillStyle = "white";
    ctx.fillRect(0, 0, canv.width, canv.height);

});

function stopDraw()
{
    pen.down = false;
}