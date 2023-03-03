var profileApp = angular.module("perfil",[]);
profileApp.controller("ctrlProfileCard",['$scope', '$http', function(){
    
}]);

/* ***************************** FORMULARIO ****************************************** */
var profileApp = angular.module("datosPerfil",[]);
profileApp.controller("ctrlDataProfileCard",['$scope', '$http', function(){

    alert($scope.id);
/*     $http({
        url :"",
        type: 'post',
        data: ''
    }).done(function(){

    }).error(function(){

    }); */
   
}]);
