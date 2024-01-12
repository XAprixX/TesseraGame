define(function () {
    "use strict";

    var names = ["Você", "Bot 2", "Bot 3", "Bot 1"],
        levels = [-1, 1, 2, 3];

    try {
        var loadedNames = JSON.parse(localStorage.getItem("names"));
        if (loadedNames) names = loadedNames;
    } catch (e) {}

    try {
        var loadedLevels = JSON.parse(localStorage.getItem("levels"));
        if (loadedLevels) levels = loadedLevels;
    } catch (e) {}

    return {
        names: names,
        levels: levels,
        sync: function () {
            localStorage.setItem("names", JSON.stringify(names));
            localStorage.setItem("levels", JSON.stringify(levels));
        }
    };
});