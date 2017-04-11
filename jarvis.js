/*
 * JARVIS: Interactive Javascript program
 * Filename: jarvis.js
 * Copyright (c) 2016 by German Bernhardt
 * E-mail: <german.bernhardt@gmail.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License.
*/

const LIB = '../lib64/';
const wapi = require(LIB + 'wapi.node');
const WAPI = require(LIB + 'wapi.js');
const cv = require(LIB + 'cv.node');
const CV = require(LIB + 'cv.js');
const gdi = require(LIB + 'gdiplus.node');

const fs = require('fs');
const spawn = require('child_process').spawn;

console.log('     __                    __');
console.log('    |__|____ __________  _|__| ______');
console.log('    |  \\__  \\\\_  __ \\  \\/ /  |/  ___/');
console.log('    |  |/ __ \\|  | \\/\\   /|  |\\___ \\');
console.log('/\\__|  (____  /__|    \\_/ |__/____  >');
console.log('\\______|    \\/                    \\/');
console.log('\n> Autor: <german.bernhardt@gmail.com>\n');

var path = './http/modules/';
var files = fs.readdirSync(path);
for(var i = 0; i < files.length; i++) {
    var ext = files[i].substr(files[i].length - 3, 3);
    if(!fs.lstatSync(path + files[i]).isDirectory()) {
        files.splice(i, 1);
        i--;
    }
}

var jarvis = require('./functions.js');
var data = require('./data.js');

// EXEC HTTP SERVER
spawn('node.exe', ['./http.js']);

while(true) {
    for(let i = 0; i < files.length; i++)
        console.log('     ' + (i + 1) + '> ' + files[i].toUpperCase().replace(/_/g, ' '));
    process.stdout.write('\nIngrese un comando: ');
    let cmd = wapi.getLine();
    process.stdout.write('\n');
    if(cmd == 0) break;
    let modPath = path + files[cmd - 1] + '/';
    if(fs.existsSync(modPath + 'index.js')) eval(fs.readFileSync(modPath + 'index.js').toString());
}
