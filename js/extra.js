//alert('hi');
console.log('imprime comentarios');

//$(document).ready(function () {
jQuery(document).ready(function($) {
        $( "#p_nivel_gob" ).text('Todos');
        $( "#p_cargo" ).text('Todos');
        $( "#p_entidad_federativa" ).text('Todas');
        $( "#p_partido_pol" ).text('Todos');
        $( "#p_princ_rep" ).text('Todos');
        $( "#p_pro_sup" ).text('Todos');
        
//        get_entidadFederativa();
//        function get_entidadFederativa()
//        {
//            $.post("modelo.php", {entidad_federativa_mcpl: true}, function (data) {
//                var array_obj = JSON.parse(data);
//                var opt_sec = "<option value=''>--Todas</option>";
//                $.each(array_obj, function (index, value) {
//                    opt_sec = opt_sec + "<option value='" + value.entidad_federativa + "'>" + value.entidad_federativa + "</option>";
//                });
//                $('#entidad-federativa-mcpl').html(opt_sec);
//            });
//        }
        
        get_partidoPolitico('');
        function get_partidoPolitico(ent_fed)
        {
            $.post("modelo.php", {partido_politico_mcpl: {
                    ent_fed_: ent_fed
                }}, function (data) {
                var array_obj = JSON.parse(data);
                var opt_sec = "<option value=''>--Todos</option>";
                $.each(array_obj, function (index, value) {
                    opt_sec = opt_sec + "<option value='" + value.part_pol + "'>" + value.part_pol +' '+value.desc_pp+ "</option>";
                });
                $('#partido-politico').html(opt_sec);
            });
        }
        
        get_principioRepresentacion();
        function get_principioRepresentacion(){
            $.post("modelo.php", {principio_representacion_mcpl: true}, function (data) {
                var array_obj = JSON.parse(data);
                var opt_sec = "<option value=''>--Todos</option>";
                $.each(array_obj, function (index, value) {
                    opt_sec = opt_sec + "<option value='" + value.principio_representacion + "'>" + value.principio_representacion + "</option>";
                });
                $('#principio-rep').html(opt_sec);
            });
        }
        
        $("#nivel-gobierno").change(function () {
            $( "#p_nivel_gob" ).text($(this).val()==''?'Todos':$(this).val());
            
        });
        $("#cargo").change(function () {
            $( "#p_cargo" ).text($(this).val()==''?'Todos':$(this).val());
        });
        $("#entidad-federativa-mcpl").change(function () {
            $( "#p_entidad_federativa" ).text($(this).val()==''?'Todos':$(this).val());
            get_partidoPolitico($(this).val());
        });
        $("#partido-politico").change(function () {
            $( "#p_partido_pol" ).text($(this).val()==''?'Todos':$(this).val());
        });
        $("#principio-rep").change(function () {
            $( "#p_princ_rep" ).text($(this).val()==''?'Todos':$(this).val());
        });
        $("#prop-sup").change(function () {
            var var_prop_sup = '';
            if ($(this).val() == 'Propietario') {
                var_prop_sup = 'Propietario/a'
            } else if ($(this).val() == 'Suplente'){
                var_prop_sup = 'Suplente'
            }
            $( "#p_pro_sup" ).text(var_prop_sup);
        });
        
        var lienso = null;
        get_grafica('', '', '', '', '', '');
        $('#search-data-mc').on('click', function (event) {

            var nivel_gobierno = $('#nivel-gobierno').val();
            var cargo = $('#cargo').val();
            var entidad_federativa_mcpl = $('#entidad-federativa-mcpl').val();
            var partido_politico = $('#partido-politico').val();
            var principio_rep = $('#principio-rep').val();
            var prop_sup = $('#prop-sup').val();
            
            get_grafica(nivel_gobierno, cargo, entidad_federativa_mcpl, partido_politico, principio_rep, prop_sup);
            window.myBar.update();

        });
        var color = Chart.helpers.color;
        function get_grafica(nivel_gobierno, cargo, entidad_federativa_mcpl, partido_politico, principio_rep, prop_sup)
        {
            $.post("modelo.php", {search_data_mcpl: {
                    nivel_gobierno_: nivel_gobierno
                    , cargo_: cargo
                    , entidad_federativa_mcpl_: entidad_federativa_mcpl
                    , partido_politico_: partido_politico
                    , principio_rep_: principio_rep
                    , prop_sup_: prop_sup
                }
            }, function (data) {
                if(lienso != undefined || lienso != null){
                    lienso.destroy();
                }
                console.log(JSON.parse(data));
                var array_data_search = JSON.parse(data);
                var array_label_x = [];
                var array_data_hombres = [];
                var array_data_mujeres = [];

                $.each(array_data_search, function (index, value) {
                    array_label_x.push(value.anio_ini + '-' + value.anio_fin);
                    array_data_hombres.push(parseInt(value.totales_hombres_suma));
                    array_data_mujeres.push(parseInt(value.totales_mujeres_suma));
                });
                /*****/
                var barChartData = {
                    labels: array_label_x,
                    datasets: [{
                        type: 'bar',
                        label: 'Hombre',
                        backgroundColor: "#79D1CF",
                        borderColor: "#4c8382",
                        data: array_data_hombres
                    }, {
                        type: 'bar',
                        label: 'Mujer',
                        backgroundColor: "#3ca807",
                        borderColor: "#266407",
                        data: array_data_mujeres
                    }]
                };
                // Define a plugin to provide data labels
//                Chart.plugins.register({
//                    afterDatasetsDraw: function(chart, easing) {
//                        // To only draw at the end of animation, check for easing === 1
//                        var ctx = chart.ctx;
//
//                        chart.data.datasets.forEach(function (dataset, i) {
//                            var meta = chart.getDatasetMeta(i);
//                            if (!meta.hidden) {
//                                meta.data.forEach(function(element, index) {
//                                    // Draw the text in black, with the specified font
//                                    ctx.fillStyle = 'rgb(0, 0, 0)';
//
//                                    var fontSize = 14;
//                                    var fontStyle = 'normal';
//                                    var fontFamily = '"Roboto", Sans-serif';
//                                    ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);
//
//                                    // Just naively convert to string for now
//                                    var dataString = dataset.data[index].toString();
//
//                                    // Make sure alignment settings are correct
//                                    ctx.textAlign = 'center';
//                                    ctx.textBaseline = 'middle';
//
//                                    var padding = 5;
//                                    var position = element.tooltipPosition();
//                                    ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
//                                });
//                            }
//                        });
//                    }
//                });
                
//                var ctx = document.getElementById("canvas").getContext("2d");
//                lienso = new Chart(ctx, {
//                    type: 'bar',
//                    data: barChartData,
//                    options: {
//                        responsive: true,
//                        title: {
//                            display: true,
//                            text: 'Mujeres y Hombres en cargos públicos'
//                        },
//                    }
//                });
//                window.myBar = lienso;

                
            });
        }
    });