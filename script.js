const canv = document.querySelector('#canv');
const ctx = canv.getContext('2d');
const penCol = document.querySelector('input[name="pencol"]');
const penwidth = document.querySelector('input[name="penwidth"]');
const rrbutton = document.querySelector('button[name="rrbutton"]');

ctx.strokeStyle = '#000000';
ctx.lineJoin = 'round';
ctx.lineCap = 'round';
ctx.lineWidth = 5;
let prevpen = {
    x:0,
    y:0,
    prevx:0,
    prevy:0,
    down:false,
    lineWidth:0,
    pencolor: ""
}

let pen = {
    x:0,
    y:0,
    prevx:0,
    prevy:0,
    down:false,
    lineWidth:0,
    pencolor: ""
}

canv.addEventListener('mousedown', (event) => {
    pen.down = true;
    pen.prevx = pen.x;
    pen.prevy = pen.y;
    pen.x = event.offsetX;
    pen.y = event.offsetY;
});

canv.addEventListener('mousemove', (event) => {
    if(!pen.down)
        return;

    

    
    pen.lineWidth = parseInt(penwidth.value);
    pen.pencolor = penCol.value;
    pen.prevx = pen.x;
    pen.prevy = pen.y;
    pen.x = event.offsetX;
    pen.y = event.offsetY;

    ctx.lineWidth = pen.lineWidth ;
    ctx.beginPath();
    ctx.strokeStyle = pen.pencolor;
    ctx.moveTo(pen.prevx, pen.prevy);
    ctx.lineTo(pen.x, pen.y);
    ctx.stroke();
    console.log("here everything goes nice");
    //sendPenStatus();
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


function sendPenStatus()
{
    if(!room)
    {
        console.log("Cannot send data! Room cannot be identified!");
        return;
    }

    //console.log("status sent!");
    room.send("draw", pen);
}
/*
if(room)
{
    room.onStateChange((state) => {
        ctx.lineWidth = state.pen.lineWidth;
        ctx.beginPath();
        ctx.strokeStyle = state.pen.pencolor;
        ctx.moveTo(state.pen.prevx, state.pen.prevy);
        ctx.lineTo(state.pen.x, state.pen.y);
        ctx.stroke();

        Object.assign(prevpen, state.pen);
    });
}
*/
