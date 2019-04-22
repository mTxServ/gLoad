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
    setGameDetails(...args)
    {
        this.serverName = arguments[0];
        this.serverUrl = arguments[1];
        this.mapName = arguments[2];
        this.maxPlayers = arguments[3];
        this.steamId = arguments[4];
        this.gameMode = arguments[5];
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


const GameDetails = (...args) => LoadHelper.prototype.setGameDetails(...args);
const SetFilesTotal = (total) => LoadHelper.prototype.setFilesTotal(total);