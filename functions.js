const LIB = '../lib32/';
const cv = require(LIB + 'cv.node');
const CV = require(LIB + 'cv.js');
const wapi = require(LIB + 'wapi.node');
const WAPI = require(LIB + 'wapi.js');

const fs = require('fs');

module.exports = {
    
    click : function() {
        wapi.mouseEvent(WAPI.MOUSE_LEFTDOWN, 0, 0, 0, 0);
        wapi.mouseEvent(WAPI.MOUSE_LEFTUP, 0, 0, 0, 0);
    },

    dbclick : function() {
        wapi.mouseEvent(WAPI.MOUSE_LEFTDOWN, 0, 0, 0, 0);
        wapi.mouseEvent(WAPI.MOUSE_LEFTUP, 0, 0, 0, 0);
        wapi.mouseEvent(WAPI.MOUSE_LEFTDOWN, 0, 0, 0, 0);
        wapi.mouseEvent(WAPI.MOUSE_LEFTUP, 0, 0, 0, 0);
    },

    pointer : function(x, y) {
        console.log('pointer');
        this.click();
        wapi.setCursorPos(x, y);
    },

    wait : function() {
        var wait = cv.imread('D:/Jarvis/modules/justificador/images/1170-745-180-1.bmp');
        wapi.usleep(500000);
        for(let i = 0; i < 4; i++) {
            let screen = cv.screenshot(0, 1170, 745, 180, 1);
            if(!image_compare(wait, screen)) i = 0;
            wapi.usleep(150000);
        }
    },

    openWindow : function() {
        // CLICK VENTANA
        pointer(145, 770);click();wapi.sleep(1);
        pointer(145, 670);click();wapi.sleep(2);
    },

    lostSession : function() {
        wapi.sendkeys('{enter}'); //ok
        // oppener window!
        wapi.sendkeys('{tab}');
        wapi.sendkeys('23012130');
        wapi.sendkeys('{enter}');
        wapi.sleep(5);
        wapi.sendkeys('{enter}'); //ok
        wait();
    },

    makeDate : function(date) {
        var date = date.split(' ');
        date[0] = date[0].split('/');
        return date[0][2] + '-' + date[0][1] + '-' + date[0][0] + ' ' + date[1];
    },

    mnu : function(index) {
        cmd = {
            'save':[120, 70],
            'copy':[285, 70],
            'paste':[313, 70],
            'clean':[337, 70],
            'delete':[365, 70],
            'genNov':[740, 460]
        };
        pointer(cmd[index][0], cmd[index][1]);
        click();
        wait();
        wapi_sendkeys('{enter}'); // SOLO MENU GUARDAR REVISAR
    },

    insertaSobre : function(sobre){
        pointer(80,140);click();wapi_sendkeys('{F11}');wait();
        wapi_sendkeys(sobre);wait();
        wapi_sendkeys('^{F11}');wait();
    },

    recorreCalendario : function(fecha) {
        var sync = false;

        // fecha a analizar
        var fechaAux = fecha.split('/');// la desmenuza
        // creo los arrays invertidos con las coordenadas
        var said = {'Sun' : 0, 'Mon' : 1, 'Tue' : 2, 'Wed' : 3, 'Thu' : 4, 'Fri' : 5, 'Sat' : 6};
        var dias = {'Sun' : 540, 'Mon' : 570, 'Tue' : 600, 'Wed' : 630, 'Thu' : 660, 'Fri' : 690, 'Sat' : 710};
        var semanas = [180, 200, 220, 240, 260, 280];
        // saco el dia de la semana
        var dia = date('D',strtotime(fechaAux[2] + '-' + fechaAux[1] + '-' + fechaAux[0]));
        var columna = dias[dia]; //obtengo la columna en base al dia
        // saco el dia 1 del mes
        var diff = date('D', strtotime(fechaAux[2] + '-' + $fechaAux[1] + '-01'));
        diff = said[diff]; //obtengo la diferencia
        // en base a la diferencia del dia 1
        // modifica la fila del calendario
        var semana = 0;
        for(let i = 1; i <= 42; i++){
            if(i <= 7) semana = 0;
            else if(i <= 14) semana = 1;
            else if(i <= 21) semana = 2;
            else if(i <= 28) semana = 3;
            else if(i <= 35) semana = 4;
            else if(i <= 42) semana = 5;
            if(i == intval(fechaAux[0]) + diff) break;
        }

        var fila = semanas[semana];
        if(sync == true) {
            let screen = cv.screenshot(0, columna - 10, fila - 5, 25, 15);
            if(searchColor(screen, 16711680)) {
                pointer(columna, fila);click();wait();
                return true;
            } else {
                return false;
            }
        } else {
            pointer(columna, fila);click();wait();
            return true;
        }
    },

    readImage : function(img) {
        var imgs = new Array();
        for(let i = 0; i < 10; i++)
            imgs[i] = cv.imread('D:/Jarvis/modules/justificador/images/' + i + '.png');
        
        //11796441
        var colors = [0, 255];
        imageConvert(img, colors);

        var text, w = 6, h = 10;
        var numbers = new Array(
            // POSICION DE FECHA
            0, 7, //DIA
            18, 25, //MES
            36, 43, 50, 57, //AÑO
            // TIEMPO
            68, 75, //HORA
            86, 93, //MINUTOS
            104, 111 //SEGUNDOS
        );

        for(let i = 0; i < numbers.length; i++) {
            let image = imagecreatetruecolor(w, h);
            imagecopy(image, img, 0, 0, numbers[i], 0, w, h);
            for(let j = 0; j < 10; j++) {
                if(imageCompare(imgs[j], image))
                    text += j;
                else text += '';
            }
            if(i == 1 || i == 3) text += '/';
            if(i == 7) text += ' ';
            if(i == 9 || i == 11) text += ':';
        }

        return text;
    },

    readTextFile : function(file) {
        if(!fs.existsSync(file)) process.exit();
        var data = fs.readFileSync(file).toString('utf8').split('\r\n');
        var result = new Array();
        for(var i = 0; i < data.length; i++) {
            if(data[i].substr(0, 4) != '105 ') {
            data.splice(i, 1);
            i--;
            } else {
            data[i] = data[i].split(' ');
            result.push(i);
            result[i] = new Array();
            result[i]['sobre'] = data[i][2];
            result[i]['nombre']='';
            for(var j = 3; j < 9; j++) {
                    if(data[i][j].match('/') == null) {
                    if(j > 3) result[i]['nombre'] += ' ';
                    result[i]['nombre'] += data[i][j];
                    // Correccion del error al exportar pdf a txt
                    // 8555 lescano, luis alberto correct
                    // lescano, luis alberto8555 incorrect
                    let len = result[i]['nombre'].replace(/[^0-9]/g, '').length;
                    if(len) {
                        result[i]['nombre'] = result[i]['sobre'] + ' ' + result[i]['nombre'];
                        result[i]['sobre'] = result[i]['nombre'].substr(result[i]['nombre'].length - len, len);
                        result[i]['nombre'] = result[i]['nombre'].substr(0, result[i]['nombre'].length - len);
                    }
                    } else break;
            }
            result[i]['fecha'] = data[i][j];
            result[i]['desde'] = data[i][j + 1];
            result[i]['hasta'] = data[i][j + 2];
            result[i]['horas'] = data[i][j + 3];
            }
        }
        return result;
    }

};