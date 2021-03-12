const colyseus = require('colyseus');
const konoschema = require('./konoschema');


exports.KonoDrawRoom = class extends colyseus.Room {
    onCreate(options){
        this.setPatchRate(13);
        this.onlobby = true;
        this.ownerset = false;
        console.log("A new room was created!");
        this.setState(new konoschema.PenState()); // correct possition

        this.onMessage("start_game", (client, message) => {
            if(client.sessionId !== this.ownerid || !this.onlobby)
                return;
            
            this.onlobby = false;
            this.drawerid = this.ownerid; // need to modify with a random player
            // here setState() was called before I solved the bug
            this.broadcast("game_started", undefined);
        });

        this.onMessage("draw", (client, data) => {
            if(this.onlobby || client.sessionId !== this.drawerid)
                return;

            let dataPen = new konoschema.PenT(data);
            this.state.pen = dataPen; // unsecure code
           });

        this.onMessage("clear_table", (client, data) => {
            if(this.onlobby || client.sessionId !== this.drawerid)
                return;

            this.broadcast("clear_table_signal", undefined);
        });

    }

    onJoin (client, options) {
        if(!this.ownerset)
        {
            this.ownerset = true;   
            this.ownerid = client.sessionId;
        }

        if(this.onlobby)
        {
            if(!options.nickname)
                return;
            
            console.log("New Player just connected!");
            client.nickname = options.nickname;

            // send all clients to the newest client
            this.clients.forEach((clnt) => {
                if(clnt.nickname !== client.nickname)
                    client.send('new_player_lobby', clnt.nickname);
            });
            this.broadcast("new_player_lobby", client.nickname, { except: client });
            if(this.ownerid !== client.sessionId)
                client.send("not_owner", undefined);
        }
        else
        {
            client.send('info',{ errormsg: 'Game already started!', errcode: 1 });
        }
    }
  
    onLeave (client, consented) {
        
        if(client.sessionId === this.ownerid && this.clients.length > 0)
        {
            this.ownerid = this.clients[0].sessionId;
            this.clients[0].send("owner_it", undefined);
        }

        if(this.onlobby)
        {   
            this.broadcast("player_left_lobby", client.nickname, { except: client });
        }
        
        console.log("Player left the game");
    }

    onDispose() {
    }

}