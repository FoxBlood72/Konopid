const canv = document.querySelector('#canv');
const ctx = canv.getContext('2d');
const penCol = document.querySelector('input[name="pencol"]');
const penwidth = document.querySelector('input[name="penwidth"]');
const rrbutton = document.querySelector('button[name="rrbutton"]');
const submit_msg = document.querySelector('#submit_msg');
const msg_form = document.querySelector('#msg_form');


var xhttp_script = new XMLHttpRequest();
xhttp_script.onreadystatechange = function() {
    if(this.readyState == 4 && this.status == 200){
        //console.log("Received the script " + this.response);
        eval(this.response);


ctx.strokeStyle = '#000000';
ctx.lineJoin = 'round';
ctx.lineCap = 'round';
ctx.lineWidth = 5;
let optimizeX = [0, 0, 0];
let optimizeY = [0, 0, 0];

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

    var rect = canv.getBoundingClientRect();
    var realX = parseInt((event.offsetX - rect.left)/scale);
    var realY = event.offsetY / scale; // we modify just width based on BoundingClientRect


    pen.down = true;
    pen.prevx = pen.x;
    pen.prevy = pen.y;
    pen.x = realX;
    pen.y = realY;
});

canv.addEventListener('mousemove', (event) => {
    if(!pen.down)
        return;

    var rect = canv.getBoundingClientRect();
    var realX = parseInt((event.offsetX - rect.left)/scale);
    var realY = event.offsetY / scale; // we modify just width based on BoundingClientRect

    pen.lineWidth = parseInt(penwidth.value);
    pen.pencolor = penCol.value;
    pen.prevx = pen.x;
    pen.prevy = pen.y;
    pen.x = realX;
    pen.y = realY;
    sendPenStatus();
});

canv.addEventListener('mouseup', stopDraw);
canv.addEventListener('mouseout', stopDraw);

rrbutton.addEventListener('click', () => {
    sendClearTableStatus();
});

function stopDraw()
{
    pen.down = false;
    sendPenStatus();
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

function sendClearTableStatus()
{
    if(!room)
        return;

    room.send("clear_table", undefined);
}

if(room)
{
    
    room.state.listen("pen", (currentValue, previousValue) => {
            // small optimization
            /*
            if(prevpen.down)
            {
                if(currentValue.prevx !== prevpen.x)
                    currentValue.prevx = prevpen.x;
                if(currentValue.prevy !== prevpen.y)
                    currentValue.prevy = prevpen.y;
            }
            */

            
        if(currentValue.down)
        {
                optimizeX.shift();
                optimizeX.push(currentValue.x);
                optimizeY.shift();
                optimizeY.push(currentValue.y);
                
            // optizatorInterpolationX = optimizatorfunction(optimizeX, optimizeY); // I took a while to find this. Math function used for drawing better
            // optizatorInterpolationY = optimizatorfunction(optimizeY, optimizeX); 
                var lastx = prevpen.x;
                var lasty = prevpen.y;
                var x = lastx;
                var y = lasty;
                
                if(prevpen.down)
                {
                    ctx.lineWidth = currentValue.lineWidth;
                    ctx.strokeStyle = currentValue.pencolor;

                    
                    ctx.beginPath();
                    ctx.moveTo(prevpen.x, prevpen.y);
                    ctx.lineTo(currentValue.x, currentValue.y);
                    ctx.stroke();
                }

                    // TODO
                    // Fix the optimizer
                //     if(prevpen.down)
                //     {
                //     console.log("LastX: " + x + "CurrentX: " + currentValue.x);
                //     while(x != currentValue.x)
                //     {
                //         if(x > currentValue.x)
                //             x -= 1;
                //         if(x < currentValue.x)
                //             x += 1;

                //         ctx.lineWidth = currentValue.lineWidth - 10;
                //         ctx.strokeStyle = currentValue.pencolor;

                //         y = optizatorInterpolationX(x);
                //         ctx.beginPath();
                //         ctx.moveTo(lastx, lasty);
                //         ctx.lineTo(x, y);
                //         ctx.stroke();

                //         lastx = x;
                //         lasty = y;
                //     }
                    
                //     while(y != currentValue.y)
                //     {
                //         if(y > currentValue.y)
                //             y -= 1;
                //         if(y < currentValue.y)
                //             y += 1;

                //         ctx.lineWidth = currentValue.lineWidth;
                //         ctx.strokeStyle = currentValue.pencolor;

                //         x = optizatorInterpolationY(y);
                //         ctx.beginPath();
                //         ctx.moveTo(lastx, lasty);
                //         ctx.lineTo(x, y);
                //         ctx.stroke();

                //         lastx = x;
                //         lasty = y;
                //     }
                // }
                    
                // }
                
        }
        

        Object.assign(prevpen, currentValue);

        });


        room.onMessage("clear_table_signal", (message) => {
            console.log("Clearing the table...");
            ctx.fillStyle = "white";
            ctx.fillRect(0, 0, canv.width, canv.height);
        });

        room.onMessage("message_received", (message) => {
            addMessage(message.msg);
        });


        $('#fancyinp').fancyInput();

    }








    }
}
xhttp_script.open("GET", "interpolation.js", true);
xhttp_script.send();

submit_msg.addEventListener("click", () => {
    sendMessage();
});
msg_form.addEventListener("submit", () => {
    sendMessage();
});


function sendMessage()
{
    var msg_input = document.getElementById('fancyinp');
    var msg = msg_input.value;
    if(!msg || msg.length === 0 || /^\s*$/.test(msg))
        return false;

    room.send("send_msg", {"msg": msg});
    msg_input.value = "";
    msg_input.nextSibling.nextSibling.innerHTML = "<b class=\"caret\">​</b>";


    return false;
}

function addMessage(msg)
{
    message_div = document.createElement('div');
    att_div = document.createAttribute('class');
    att_div.value = "speech-bubble";
    message_div.setAttributeNode(att_div);
    p_msg = document.createElement('p');
    p_msg.innerHTML = msg;
    message_div.appendChild(p_msg);
    document.getElementById('chat').appendChild(message_div);
    var objDiv = document.getElementById("chat");
    objDiv.scrollTop = objDiv.scrollHeight;
}










var scale=1.00;
var originalWindowWidth = screen.width;
var originalCanvasWidth = $('#canv').width();
function debounce(func, wait, immediate) {
  var timeout;
  return function() {
    var context = this, args = arguments;
    var later = function() {
      timeout = null;
      if (!immediate) func.apply(context, args);
    };
    var callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) func.apply(context, args);
  };
};
var resizeCanvas = debounce(function() {
  scale=window.innerWidth/originalWindowWidth;
  $('#canv').css('width', originalCanvasWidth*scale);
  console.log($('#canv').height());
  $('#chat').css('height', $('#canv').height());
  console.log($('#chat').height());
}, 100);
window.addEventListener('resize', resizeCanvas);
resizeCanvas();