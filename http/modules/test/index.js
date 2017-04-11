
let skel = fs.readFileSync(modPath + 'test.htm').toString();

let material = ['german', 'angeles', 'nicolas', 'alma', 'betiana', 'simon', 'julia', 'pablo', 'jorge', 'carolina', 'fabian'];
let str = '//var hola = [' + material + '];\n';

fs.writeFileSync(modPath + 'test.html', skel.replace(/scriptChange/, str));
spawn('C:\\Program Files (x86)\\Mozilla Firefox\\firefox.exe', ['http://localhost/modules/test/test.html']);