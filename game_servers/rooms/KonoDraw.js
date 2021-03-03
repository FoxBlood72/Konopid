const colyseus = require('colyseus');

exports.KonoDrawRoom = class extends colyseus.Room {
    onCreate(options){
        this.onlobby = true;
        this.ownerset = false;
        console.log("A new room was created!");
    }

    onJoin (client, options) {
        if(!this.ownerset)
        {
            this.ownerset = true;   
            this.ownerid = client.sessionId;
        }

        if(this.onlobby)
        {
            console.log("New Player just connected!");
            client.nickname = options.nickname;
            this.clients.forEach((clnt) => {
                if(clnt.nickname !== client.nickname)
                    client.send('new_player_lobby', clnt.nickname);
            });
            this.broadcast("new_player_lobby", client.nickname, { except: client });
            
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
        }

        if(this.onlobby)
        {
            console.log("Player left the lobby");
            
            this.broadcast("player_left_lobby", client.nickname, { except: client });
        }
        
        
    }

    onDispose() {
    }

}