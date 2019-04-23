/**
 * gLoad
 * gload.js
 * An helper script with pre-made functions to make the loading-screen development faster
 *
 * @author Gabriel Santamaria <gaby.santamaria@outlook.fr>
 * @license Apache-2.0
 */

class LoadHelper {

    /**
     * Constructor of gload class.
     */
    constructor()
    {

    }

    /**
     * Mutators
     */
    setGameDetails(serverName, serverUrl, mapName, maxPlayers, steamId, gameMode)
    {
        this.serverName = serverName;
        this.serverUrl = serverUrl;
        this.mapName = mapName;
        this.maxPlayers = maxPlayers;
        this.steamId = steamId;
        this.gameMode = gameMode;
    }
    setFilesTotal(total) { this.filesTotal = total; }

    /**
     * Accessors
     */
    getServerName() { return this.serverName; }
    getServerUrl() { return this.serverUrl; }
    getMapName() { return this.mapName; }
    getMaxPlayers() { return this.maxPlayers; }
    getSteamId() { return this.steamId; }
    getGameMode() { return this.gameMode; }
    getFilesTotal() { return this.total; }
}

var gLoad = new LoadHelper();



const GameDetails = (...args) => gLoad.setGameDetails(...args);
const SetFilesTotal = (total) => gLoad.setFilesTotal(total);