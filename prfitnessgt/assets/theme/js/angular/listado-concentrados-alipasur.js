var listadoConcentradosApp = angular.module("listado-concentrados", []);

listadoConcentradosApp.controller('ListadoConcentradosCtrl', ['$http', '$scope', function($http, $scope) {
    $scope.listadoConcentrados = new Array();

    $http({
        // method: 'post',
        url: 'http://localhost/admin_grupo_crecipollo/ctrl_alipasur/get_all_concentrados',
        //data: $scope.newFormula, //forms user object
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    }).then(function successCallback(response) {
        console.log(response.data);

        $scope.listadoConcentrados = response.data;

        //this.dt = {};
        /* if (response.data.resultado == "ok") {
             swal({
                 title: 'En hora buena',
                 text: 'Se ha creado correctamente la nueva formula',
                 type: 'success',
                 showConfirmButton: false,
                 timer: 2300,
             }).catch(swal.noop);
         }*/
        //demo.showSwal('success-message-save');
        /*setTimeout(() => {
            window.location.reload();
        }, 2600);*/
    }, function errorCallback(response) {
        console.log(response);
    });

}]);

angular.bootstrap(document.getElementById("acordeon"), ['listado-concentrados']);