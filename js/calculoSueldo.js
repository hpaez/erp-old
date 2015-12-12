function buscarSueldo() {
    var valorrut = $("#rut").val();
	if (valorrut != "") {
        $.post("../rrhh/consulta/rut.php", {valorBusqueda: valorrut}, function(mensaje1) {
            $("#resultadoBusqueda").html(mensaje1);
        }); 
    } else { 
        ("#resultadoBusqueda").html('');
	};
};

function buscarAfp() {
    var valorrut = $("#rut").val();
	if (valorrut != "") {
        $.post("../rrhh/consulta/afp.php", {valorBusqueda: valorrut}, function(mensaje2) {
            $("#resultadoBusqueda2").html(mensaje2);
        }); 
    } else { 
        ("#resultadoBusqueda2").html('');
	};
};

var utm = 44553; //octubre 2015
var uf = 25352.78;//1 octubre 2015
var imm = 241000; // ingreso minimo mensual
var grat = imm*4.75/12;
var topeImponibleCotizacionesUF = 73.2; // todo 2015
var topeImponibleSeguroUF = 109.8; // todo 2015
var factor = [0, 0.040, 0.080, 0.135, 0.230, 0.304, 0.355, 0.400];
var rebaja = [utm*0, utm*0.54, utm*1.74, utm*4.49, utm*11.14, utm*17.8, utm*23.92, utm*30.67];

function impuestoCalc(dinero){
    var error = -1;
    var desde = [utm*0, (utm*13.5)+0.01, (utm*30)+0.01, (utm*50)+0.01, (utm*70)+0.01, (utm*90)+0.01, (utm*120)+0.01, (utm*150)+0.01];
    var hasta = [utm*13.5, utm*30, utm*50, utm*70, utm*90, utm*120, utm*150, utm*3000];

    for(var i = 0; i<8; i++){
        if(dinero > desde[i] && dinero < hasta[i]){
            return i;
        }
    }
    return error;
}
function startCalc(){
    interval = setInterval("calc()",1);
}
function calc(){
    if(document.formulario.sueldo.value == null){
        sueldo = 0;
    }else{
        sueldo = parseInt(document.formulario.sueldo.value);
        if(grat>sueldo*0.25){document.formulario.gratificacion.value = Math.round(sueldo*0.25);}else{document.formulario.gratificacion.value = Math.round(grat);}
    }
    if(document.formulario.gratificacion.value == ''){gratificacion = grat; document.formulario.gratificacion.value = grat;}else{gratificacion = parseInt(document.formulario.gratificacion.value);}
    // gratificación: grat o 25% de base, el q sea menor.

    if(document.formulario.comisiones.value == ''){comisiones = 0;}else{comisiones = parseInt(document.formulario.comisiones.value);}
    if(document.formulario.bono1.value == ''){bono1 = 0;}else{bono1 = parseInt(document.formulario.bono1.value);}
    if(document.formulario.bono2.value == ''){bono2 = 0;}else{bono2 = parseInt(document.formulario.bono2.value);}
    if(document.formulario.hrsextras.value == ''){hrsextras = 0;}else{hrsextras = parseInt(document.formulario.hrsextras.value);}
    if(document.formulario.colacion.value == ''){colacion = 0;}else{colacion = parseInt(document.formulario.colacion.value);}
    if(document.formulario.movilizacion.value == ''){movilizacion = 0;}else{movilizacion = parseInt(document.formulario.movilizacion.value);}

    hrsextras = hrsextras*(((sueldo/30)*28)/180)*1,5;

    totalhaberes = sueldo + gratificacion + comisiones + bono1 + bono2 + hrsextras + colacion + movilizacion;
    document.formulario.totalhaberes.value = totalhaberes;

    baseimponible = totalhaberes - colacion - movilizacion // si es mayor a tope imponible entonces tope imponible
    if(baseimponible > (topeImponibleCotizacionesUF*uf)){
        baseimponible = Math.round(topeImponibleCotizacionesUF*uf);
    }
    else{
        baseimponible = baseimponible;
    }
    document.formulario.baseimponible.value = baseimponible;

    afp = document.formulario.afp.value;
    if(afp == 'Cuprum'){
        afp = 0.1148;
    }
    else if(afp == 'Habitat'){
        afp = 0.1127;
    }
    else if(afp == 'PlanVital'){
        afp = 0.1047; // bajo de 2,36 a 0,47 quedando como la mas baja
    }
    else if(afp == 'Provida'){
        afp = 0.1154;
    }
    else if(afp == 'Modelo'){
        afp = 0.1077;
    }
    else if(afp == 'sn'){
        afp = 0.1077;
    }

    afpcalc = afp*baseimponible;
    document.formulario.afpcalc.value = Math.round(afpcalc); //si mayor que tope imponible entonces afp*tope impoible

    isapre = 0.07*baseimponible;
    document.formulario.isapre.value = Math.round(isapre); //si mayor que  uf 7%*baseimponible si no????

    baseimponibleseg = totalhaberes - colacion - movilizacion // si es mayor a tope imponible entonces tope imponible
    if(baseimponibleseg > (topeImponibleSeguroUF*uf)){
        baseimponibleseg = Math.round(topeImponibleSeguroUF*uf);
    }
    else{
        baseimponibleseg = baseimponible;
    }
    document.formulario.baseimponibleseg.value = baseimponibleseg;

    seguro = document.formulario.seguro.value;
    if(seguro == 1){
        seguro = 0.006;
    }
    else if(seguro == 0){
        seguro = 0;
    }

    segurocalc = seguro*baseimponibleseg;
    document.formulario.segurocalc.value = Math.round(segurocalc);

    if(document.formulario.apv.value == ''){apv = 0;}else{apv = parseInt(document.formulario.apv.value);}

    //si isapre es mayor que 5.06*UF entonces 5.06*UF, si no isapre
    if(isapre > topeImponibleCotizacionesUF*uf){
        isapreTributable = topeImponibleCotizacionesUF*uf;
    }
    else{
        isapreTributable = isapre;
    }
    basetributable = totalhaberes- colacion - movilizacion - afpcalc - segurocalc - apv - isapreTributable; // parece q no se redondea
    document.formulario.basetributable.value = Math.round(basetributable);

    impuesto = (basetributable*factor[impuestoCalc(basetributable)])-rebaja[impuestoCalc(basetributable)];
    document.formulario.impuesto.value = Math.round(impuesto);

    totaldescuentos = afpcalc + isapre + segurocalc + apv + impuesto;
    document.formulario.totaldescuentos.value = Math.round(totaldescuentos);

    sueldoliquido = totalhaberes - totaldescuentos;
    document.formulario.sueldoliquido.value = Math.round(sueldoliquido);
}

function stopCalc(){
    clearInterval(interval);
}