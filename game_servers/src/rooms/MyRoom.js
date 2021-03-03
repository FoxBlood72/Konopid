const colyseus = require('colyseus');
const MyRoomState = require('./schema/MyRoomState').MyRoomState;

exports.MyRoom = class extends colyseus.Room {

    onCreate (options) {
      console.log("A new room was created!");
      this.setState(new MyRoomState());

      this.onMessage("type", (client, message) => {
        //
        // handle "type" message.
        //
      });

    }

    onJoin (client, options) {
      console.log("New Player!");
    }

    onLeave (client, consented) {
      console.log("Player left the game");
    }

    onDispose() {
    }

}
