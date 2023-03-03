var formulasTab = angular.module('formulas', []);

formulasTab.controller('formulasCtrl', ['$http', '$scope', function($http, $scope) {

    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $scope.id_tipo_concentrado = 0;
    $scope.total_materias = 0;
    $scope.proteina = 0;
    $scope.energia_aves = 0;
    $scope.precio = 0;
    $scope.energia_cerdos = 0;
    $scope.metionina = 0;
    $scope.metionina_cistina = 0;
    $scope.lisina = 0;
    $scope.calcio = 0;
    $scope.fosforo = 0;
    $scope.acido_linoleico = 0;
    $scope.grasa = 0;
    $scope.fibra = 0;
    $scope.ceniza = 0;
    $scope.sodio = 0;
    $scope.cloruros = 0;
    $scope.hierro = 0;
    $scope.cobre = 0;
    $scope.manganeso = 0;
    $scope.selenio = 0;
    $scope.vitamina_a = 0;
    $scope.vitamina_b3 = 0;
    $scope.vitamina_e = 0;
    $scope.vitamina_k = 0;
    $scope.vitamina_b1 = 0;
    $scope.vitamina_b2 = 0;
    $scope.vitamina_b6 = 0;
    $scope.vitamina_b12 = 0;
    $scope.acido_folico = 0;
    $scope.pantotenato_de_calcio = 0;
    $scope.newFormula = new Array();
    $scope.nextOneButton = true;

    this.title = 'Crear nueva fórmula de concentrado.';
    this.button_finish = 'crear formula';
    $scope.dt = {};

    $scope.setTipoConcentrado = function(value) {
        $scope.id_tipo_concentrado = value;
    }

    this.submitForm = function() {
        $http({
            method: 'post',
            url: 'http://localhost/admin_grupo_crecipollo/ctrl_alipasur/test',
            data: $scope.newFormula, //forms user object
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        }).then(function successCallback(response) {
            //this.dt = {};
            if (response.data.resultado == "ok") {
                swal({
                    title: 'En hora buena',
                    text: 'Se ha creado correctamente la nueva formula',
                    type: 'success',
                    showConfirmButton: false,
                    timer: 2300,
                }).catch(swal.noop);
            }
            //demo.showSwal('success-message-save');
            setTimeout(() => {
                window.location.reload();
            }, 2600);
        }, function errorCallback(response) {
            console.log(response);
        });
    };
}]);



formulasTab.controller('addRowsCtrl', ['$http', '$scope', function($http, $scope) {
    //console.log($scope.$parent.dt);
    var init = $scope.$parent.dt;
    $scope.materias = [init];


    $scope.addNewChoice = function() {
        $scope.materias.push({ id_tipo_concentrado: init.id_tipo_concentrado });
    };


    $scope.calculate = function() {
        var sum_materias = 0;
        for (let i = 0; i < $scope.materias.length; i++) {
            if ($scope.materias[i]['cant_materia'] != undefined || typeof($scope.materias[i]['cant_materia']) == 'number') {
                sum_materias += $scope.materias[i]['cant_materia'];
            } else {
                //demo.showSwal('error-number');
            }
        }
        $scope.$parent.total_materias = sum_materias;
        $scope.calculateTotal();
    }

    $scope.calculateTotal = function() {
        var materiasArray = [];
        for (let i = 0; i < $scope.materias.length; i++) {
            if ($scope.materias[i]['id_materia'] != undefined || typeof($scope.materias[i]['id_materia']) == '') {
                materiasArray[i] = $scope.materias[i]['id_materia'];
                /* suma */
                /* obtener los datos de cada una de las materias. */
                $http({
                    method: 'post',
                    url: 'http://localhost/admin_grupo_crecipollo/ctrl_alipasur/get_fomulas_data_to_formulas',
                    data: materiasArray, //forms user object
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                }).then(function successCallback(response) {
                    //console.log(materiasArray);
                    var values = new Array();
                    for (let i = 0; i < $scope.materias.length; i++) {
                        if ($scope.materias[i]['cant_materia'] != undefined || typeof($scope.materias[i]['cant_materia']) == 'number') {
                            //console.log($scope.materias[i]['id_materia']);                    
                            Array.from(response.data).forEach(element => {
                                if (element.id_materia_prima == $scope.materias[i]['id_materia']) {
                                    //console.log( element.energia_aves + " * "+  $scope.materias[i]['cant_materia'] + " / " + 100)
                                    energia_aves = ((element.energia_aves * $scope.materias[i]['cant_materia']) / element.valor_calculo_unitario);
                                    precio = ((element.precio * $scope.materias[i]['cant_materia']) / element.valor_calculo_unitario);
                                    proteina = ((element.proteina * $scope.materias[i]['cant_materia']) / element.valor_calculo_unitario);
                                    energia_cerdos = ((element.energia_cerdos * $scope.materias[i]['cant_materia']) / 100);
                                    metionina = ((element.metionina * $scope.materias[i]['cant_materia']) / 100);
                                    metionina_cistina = ((element.metionina_cistina * $scope.materias[i]['cant_materia']) / 100);
                                    lisina = ((element.lisina * $scope.materias[i]['cant_materia']) / 100);
                                    calcio = ((element.calcio * $scope.materias[i]['cant_materia']) / 100);
                                    fosforo = ((element.fosforo * $scope.materias[i]['cant_materia']) / 100);
                                    acido_linoleico = ((element.acido_linoleico * $scope.materias[i]['cant_materia']) / 100);
                                    grasa = ((element.grasa * $scope.materias[i]['cant_materia']) / 100);
                                    fibra = ((element.fibra * $scope.materias[i]['cant_materia']) / 100);
                                    ceniza = ((element.ceniza * $scope.materias[i]['cant_materia']) / 100);
                                    sodio = ((element.sodio * $scope.materias[i]['cant_materia']) / 100);
                                    cloruros = ((element.cloruros * $scope.materias[i]['cant_materia']) / 100);
                                    hierro = ((element.hierro * $scope.materias[i]['cant_materia']) / 100);
                                    cobre = ((element.cobre * $scope.materias[i]['cant_materia']) / 100);
                                    manganeso = ((element.manganeso * $scope.materias[i]['cant_materia']) / 100);
                                    selenio = ((element.selenio * $scope.materias[i]['cant_materia']) / 100);
                                    vitamina_a = ((element.vitamina_a * $scope.materias[i]['cant_materia']) / 100);
                                    vitamina_b3 = ((element.vitamina_b3 * $scope.materias[i]['cant_materia']) / 100);
                                    vitamina_e = ((element.vitamina_e * $scope.materias[i]['cant_materia']) / 100);
                                    vitamina_k = ((element.vitamina_k * $scope.materias[i]['cant_materia']) / 100);
                                    vitamina_b1 = ((element.vitamina_b1 * $scope.materias[i]['cant_materia']) / 100);
                                    vitamina_b2 = ((element.vitamina_b2 * $scope.materias[i]['cant_materia']) / 100);
                                    vitamina_b6 = ((element.vitamina_b6 * $scope.materias[i]['cant_materia']) / 100);
                                    vitamina_b12 = ((element.vitamina_b12 * $scope.materias[i]['cant_materia']) / 100);
                                    acido_folico = ((element.acido_folico * $scope.materias[i]['cant_materia']) / 100);
                                    pantotenato_de_calcio = ((element.pantotenato_de_calcio * $scope.materias[i]['cant_materia']) / 100);


                                    values.push({
                                        "precio": precio.toFixed(2),
                                        "proteina": proteina.toFixed(2),
                                        "energia_aves": energia_aves.toFixed(2),
                                        "energia_cerdos": energia_cerdos.toFixed(2),
                                        "metionina": metionina.toFixed(2),
                                        "metionina_cistina": metionina_cistina.toFixed(2),
                                        "lisina": lisina.toFixed(2),
                                        "calcio": calcio.toFixed(2),
                                        "fosforo": fosforo.toFixed(2),
                                        "acido_linoleico": acido_linoleico.toFixed(2),
                                        "grasa": grasa.toFixed(2),
                                        "fibra": fibra.toFixed(2),
                                        "ceniza": ceniza.toFixed(2),
                                        "sodio": sodio.toFixed(2),
                                        "cloruros": cloruros.toFixed(2),
                                        "hierro": hierro.toFixed(2),
                                        "cobre": cobre.toFixed(2),
                                        "manganeso": manganeso.toFixed(2),
                                        "selenio": selenio.toFixed(2),
                                        "vitamina_a": vitamina_a.toFixed(2),
                                        "vitamina_b3": vitamina_b3.toFixed(2),
                                        "vitamina_e": vitamina_e.toFixed(2),
                                        "vitamina_k": vitamina_k.toFixed(2),
                                        "vitamina_b1": vitamina_b1.toFixed(2),
                                        "vitamina_b2": vitamina_b2.toFixed(2),
                                        "vitamina_b6": vitamina_b6.toFixed(2),
                                        "vitamina_b12": vitamina_b12.toFixed(2),
                                        "acido_folico": acido_folico.toFixed(2),
                                        "pantotenato_de_calcio": pantotenato_de_calcio.toFixed(2),
                                    });
                                }
                            });
                        } else {
                            //demo.showSwal('error-number');
                        }
                        var sum_proteina = 0;
                        var sum_energia_aves = 0;
                        var sum_precio = 0;
                        var sum_energia_cerdos = 0;
                        var sum_metionina = 0;
                        var sum_metionina_cistina = 0;
                        var sum_lisina = 0;
                        var sum_calcio = 0;
                        var sum_fosforo = 0;
                        var sum_acido_linoleico = 0;
                        var sum_grasa = 0;
                        var sum_fibra = 0;
                        var sum_ceniza = 0;
                        var sum_sodio = 0;
                        var sum_cloruros = 0;
                        var sum_hierro = 0;
                        var sum_cobre = 0;
                        var sum_manganeso = 0;
                        var sum_selenio = 0;
                        var sum_vitamina_a = 0;
                        var sum_vitamina_b3 = 0;
                        var sum_vitamina_e = 0;
                        var sum_vitamina_k = 0;
                        var sum_vitamina_b1 = 0;
                        var sum_vitamina_b2 = 0;
                        var sum_vitamina_b6 = 0;
                        var sum_vitamina_b12 = 0;
                        var sum_acido_folico = 0;
                        var sum_pantotenato_de_calcio = 0;
                        if ($scope.materias[i]['cant_materia'] != undefined || typeof($scope.materias[i]['cant_materia']) == 'number' || typeof($scope.materias[i]['cant_materia']) != '') {


                            for (let i = 0; i < values.length; i++) {
                                sum_proteina += Number(values[i].proteina);
                                //console.log(values[i].energia);
                                sum_energia_aves += Number(values[i].energia_aves);
                                sum_precio += Number(values[i].precio);

                                sum_energia_cerdos += Number(values[i].energia_cerdos);
                                sum_metionina += Number(values[i].metionina);
                                sum_metionina_cistina += Number(values[i].metionina_cistina);
                                sum_lisina += Number(values[i].lisina);
                                sum_calcio += Number(values[i].calcio);
                                sum_fosforo += Number(values[i].fosforo);
                                sum_acido_linoleico += Number(values[i].acido_linoleico);
                                sum_grasa += Number(values[i].grasa);
                                sum_fibra += Number(values[i].fibra);
                                sum_ceniza += Number(values[i].ceniza);
                                sum_sodio += Number(values[i].sodio);
                                sum_cloruros += Number(values[i].cloruros);
                                sum_hierro += Number(values[i].hierro);
                                sum_cobre += Number(values[i].cobre);
                                sum_manganeso += Number(values[i].manganeso);
                                sum_selenio += Number(values[i].selenio);
                                sum_vitamina_a += Number(values[i].vitamina_a);
                                sum_vitamina_b3 += Number(values[i].vitamina_b3);
                                sum_vitamina_e += Number(values[i].vitamina_e);
                                sum_vitamina_k += Number(values[i].vitamina_k);
                                sum_vitamina_b1 += Number(values[i].vitamina_b1);
                                sum_vitamina_b2 += Number(values[i].vitamina_b2);
                                sum_vitamina_b6 += Number(values[i].vitamina_b6);
                                sum_vitamina_b12 += Number(values[i].vitamina_b12);
                                sum_acido_folico += Number(values[i].acido_folico);
                                sum_pantotenato_de_calcio += Number(values[i].pantotenato_de_calcio);

                            }

                            $scope.$parent.proteina = sum_proteina.toFixed(2);
                            $scope.$parent.energia_aves = sum_energia_aves.toFixed(2);
                            $scope.$parent.precio = sum_precio.toFixed(2);
                            $scope.$parent.energia_cerdos = sum_energia_cerdos.toFixed(2);
                            $scope.$parent.metionina = sum_metionina.toFixed(2);
                            $scope.$parent.metionina_cistina = sum_metionina_cistina.toFixed(2);
                            $scope.$parent.lisina = sum_lisina.toFixed(2);
                            $scope.$parent.calcio = sum_calcio.toFixed(2);
                            $scope.$parent.fosforo = sum_fosforo.toFixed(2);
                            $scope.$parent.acido_linoleico = sum_acido_folico.toFixed(2);
                            $scope.$parent.grasa = sum_grasa.toFixed(2);
                            $scope.$parent.fibra = sum_fibra.toFixed(2);
                            $scope.$parent.ceniza = sum_ceniza.toFixed(2);
                            $scope.$parent.sodio = sum_sodio.toFixed(2);
                            $scope.$parent.cloruros = sum_cloruros.toFixed(2);
                            $scope.$parent.hierro = sum_hierro.toFixed(2);
                            $scope.$parent.cobre = sum_cobre.toFixed(2);
                            $scope.$parent.manganeso = sum_manganeso.toFixed(2);
                            $scope.$parent.selenio = sum_selenio.toFixed(2);
                            $scope.$parent.vitamina_a = sum_vitamina_a.toFixed(2);
                            $scope.$parent.vitamina_b3 = sum_vitamina_b3.toFixed(2);
                            $scope.$parent.vitamina_e = sum_vitamina_e.toFixed(2);
                            $scope.$parent.vitamina_k = sum_vitamina_k.toFixed(2);
                            $scope.$parent.vitamina_b1 = sum_vitamina_b1.toFixed(2);
                            $scope.$parent.vitamina_b2 = sum_vitamina_b2.toFixed(2);
                            $scope.$parent.vitamina_b6 = sum_vitamina_b6.toFixed(2);
                            $scope.$parent.vitamina_b12 = sum_vitamina_b12.toFixed(2);
                            $scope.$parent.acido_folico = sum_acido_folico.toFixed(2);
                            $scope.$parent.pantotenato_de_calcio = sum_pantotenato_de_calcio.toFixed(2);


                            $scope.$parent.newFormula.push({
                                "id_tipo_concentrado": $scope.$parent.id_tipo_concentrado,
                                "precio": $scope.$parent.precio,
                                "cantidad_materias": $scope.$parent.total_materias,
                                "proteina": $scope.$parent.proteina,
                                "energia_aves": $scope.$parent.energia_aves,
                                "energia_cerdos": $scope.$parent.energia_cerdos,
                                "metionina": $scope.$parent.metionina,
                                "metionina_cistina": $scope.$parent.metionina_cistina,
                                "lisina": $scope.$parent.lisina,
                                "calcio": $scope.$parent.calcio,
                                "fosforo": $scope.$parent.fosforo,
                                "acido_linoleico": $scope.$parent.acido_linoleico,
                                "grasa": $scope.$parent.grasa,
                                "fibra": $scope.$parent.fibra,
                                "ceniza": $scope.$parent.ceniza,
                                "sodio": $scope.$parent.sodio,
                                "cloruros": $scope.$parent.cloruros,
                                "hierro": $scope.$parent.hierro,
                                "cobre": $scope.$parent.cobre,
                                "manganeso": $scope.$parent.manganeso,
                                "selenio": $scope.$parent.selenio,
                                "vitamina_a": $scope.$parent.vitamina_a,
                                "vitamina_b3": $scope.$parent.vitamina_b3,
                                "vitamina_e": $scope.$parent.vitamina_e,
                                "vitamina_k": $scope.$parent.vitamina_k,
                                "vitamina_b1": $scope.$parent.vitamina_b1,
                                "vitamina_b2": $scope.$parent.vitamina_b2,
                                "vitamina_b6": $scope.$parent.vitamina_b6,
                                "vitamina_b12": $scope.$parent.vitamina_b12,
                                "acido_folico": $scope.$parent.acido_folico,
                                "pantotenato_de_calcio": $scope.$parent.pantotenato_de_calcio
                            });
                            //console.log($scope.$parent.newFormula);
                            if ($scope.$parent.newFormula.length > 1) {
                                $scope.$parent.newFormula.shift();
                            }
                            //console.log($scope.$parent.newFormula);
                        }
                    }
                    /* demo.showSwal('success-message-save');*/
                }, function errorCallback(response) {
                    //demo.showSwal('error-number');
                });

                /* fin suma */


            } else {
                swal({
                    title: 'Error',
                    text: 'Debes llenar primero la materia',
                    type: 'error',
                    confirmButtonClass: "btn btn-info btn-fill",
                    buttonsStyling: false
                }).catch(swal.noop);
            }
        }
    };
    $scope.removeChoice = function(item) {
        /*
         * se estipula que no se elimine el primer row. 
         */
        if (($scope.materias.length - 1) != 0) {
            /*var lastItem = $scope.materias.length - 1;*/
            /*var index = $scope.materias.indexOf(item);
            $scope.materias.splice(index, 1);*/
            $scope.materias.splice(item, 1);
        }
    };
}]);

formulasTab.controller('showDetailsCtrl', ['$http', '$scope', function($http, $scope) {}]);

/* 
energia_cerdos 
metionina
metionina_cistina
lisina
calcio
fosforo
acido_linoleico
grasa
fibra
ceniza
sodio
cloruros
hierro
cobre
manganeso
selenio
vitamina_a
vitamina_b3
vitamina_e
vitamina_k
vitamina_b1
vitamina_b2
vitamina_b6
vitamina_b12
acido_folico
pantotenato_de_calcio
*/

angular.bootstrap(document.getElementById("nuevaFormula"), ['formulas']);