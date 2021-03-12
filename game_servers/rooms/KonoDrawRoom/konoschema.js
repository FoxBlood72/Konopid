const schema = require('@colyseus/schema');
const Schema = schema.Schema;

class PenT extends Schema{
    constructor(recv_data){
        super();
        /*
        if(recv_data !== undefined)
        {
            this.x = recv_data.x;
            this.y = recv_data.y;
            this.prevx = recv_data.prevx;
            this.prevy = recv_data.prevy;
            this.lineWidth = recv_data.lineWidth;
            this.pencolor = recv_data.pencolor;
            this.down = recv_data.down;
        }
        else
        {
            this.x = 0;
            this.y = 0;
            this.prevx = 0;
            this.prevy = 0;
            this.lineWidth = 0;
            this.pencolor = "#00000";
            this.down = false;
        }
        */
        if(recv_data !== undefined)
            Object.assign(this, recv_data);
        else
            Object.assign(this, {x:0, y:0, prevx: 0, prevy:0, lineWidth:0, down:false});
        
    }
}

schema.defineTypes(PenT, {
    x: "uint16",
    y: "uint16",
    prevx: "uint16",
    prevy: "uint16",
    lineWidth: "uint16",
    pencolor: "string",
    down: "boolean"
});

class PenState extends Schema{
    constructor() {
        super();
        
        this.pen = new PenT();
    }
}
schema.defineTypes(PenState, {
    pen: PenT
});


module.exports = {PenState, PenT};