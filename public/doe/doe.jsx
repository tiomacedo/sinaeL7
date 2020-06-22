#target estoolkit # dbg
"ExtendScript Toolkit.exe" -cmd compiler.jsx

function abrirModelo(){
    app.open(File("~//Desktop/ModeloDOE.indt"));
}
abrirModelo(); /* é necessário abrir o modelo antes de declarar o documento ativo */

alert ("Exportação e Aplicações finalizadas!");