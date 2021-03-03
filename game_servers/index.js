const colyseus = require("colyseus");
const port = 2567;
const KonoDrawRoom = require('./rooms/KonoDraw').KonoDrawRoom;

console.log("[INFO] Trying to start the server...");
const gameServer = new colyseus.Server();
gameServer.listen(port);
console.log("[INFO] Server started successfully!");

gameServer.define("konodraw", KonoDrawRoom).filterBy(['session']);
