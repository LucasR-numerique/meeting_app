
app.controller('MeetingAppSubjectsPlanCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', 'zeapps_modal', '$uibModal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, zeapps_modal, $uibModal) {

        $scope.notes = [];
        $scope.form = {};

        $scope.edition_encours_global == false;


        $scope.addSubject = function () {

            zeapps_modal.loadModule("meeting_app", "addSubject", {}, function(objReturn) {
                loadList() ;
            });

        };


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        /*********** Check id send on URL and display the good project ***********/

        var getProjectId = function()
        {

            $http.get('/meeting_app/project/get/'+ $routeParams.id_project).then(function (response) {
                if (response.data && response.data != "false") {

                    $scope.project = response.data;
                }

            });
        };
        getProjectId();


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        /*********** Check id send on URL and display the good project ***********/

        var getMeetId = function()
        {

            $http.get('/meeting_app/meet/get/'+ $routeParams.id_meet).then(function (response) {
                if (response.data && response.data != "false") {

                    $scope.meet = response.data;
                }

            });
        };
        getMeetId();

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        /*********** Load all subjects of a project saved in BDD ***********/

        var loadList = function () {

            $http.get('/meeting_app/subject/getSubByMeet/'+ $routeParams.id_meet).then(function (response) {
                if (response.status == 200) {
                    $scope.subjects = response.data ;


                }
            });
        };
        loadList() ;


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        $scope.delete_subject = function (id_subject) {

            var modalInstance = $uibModal.open({

                animation: true,
                templateUrl: '/assets/angular/popupModalDeBase.html',
                controller: 'ZeAppsPopupModalDeBaseCtrl',
                size: 'lg',
                resolve: {
                    titre: function () {
                        return 'Attention';
                    },
                    msg: function () {
                        return 'Souhaitez-vous supprimer définitivement ce projet ?';
                    },
                    action_danger: function () {
                        return 'Annuler';
                    },
                    action_primary: function () {
                        return false;
                    },
                    action_success: function () {
                        return 'Je confirme la suppression';
                    }

                }

            });

            /********** Send the Http request to the Php controller and reload projects **********/

            modalInstance.result.then(function (selectedItem) {
                if (selectedItem.action == 'danger') {

                } else if (selectedItem.action == 'success') {
                    // console.log(workload_id);
                    $http.get('/meeting_app/subject/delete/' + id_subject).then(function (response) {
                        if (response.status == 200) {
                            console.log(response.data);
                            loadList() ;
                        }
                    });
                }

            }, function () {
                //console.log("rien");
            });

        };


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        /******* Create an empty field for note *******/

        $scope.createNote = function (type_note) {
            if ($scope.edition_encours_global == false) {
                var data = {};

                data.name = "";
                data.description = "";
                data.description_edit = "";
                data.type_note = type_note;
                data.edition_encours = true ;

                $scope.notes.unshift(data);

                $scope.edition_encours_global = true;
            }
        }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        /******* Save note in database *******/


        $scope.saveNote = function(note)
        {

            var data = {};

            if ($routeParams.id_meet && $routeParams.id_meet != 0 && $routeParams.id_project && $routeParams.id_project != 0 ) {
                data.id_meet = $routeParams.id_meet;
                data.id_project = $routeParams.id_project;
            }



            data.id = note.id;
            data.description = note.description;
            data.type_note = note.type_note;

            $http.post('/meeting_app/subject/saveNote', angular.toJson(data)).then(function (obj) {

                note.id = obj.data.id;
                console.log(obj.data);


            });


        }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        /******** Load all notes in the view ********/

        var loadNotes = function () {

            $http.get('/meeting_app/subject/getNoteByMeet/'+ $routeParams.id_meet).then(function (response) {
                if (response.status == 200) {
                    $scope.notes = response.data ;
                }

            });
        };
        loadNotes() ;


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        /****** Test for type logos with ng-class ********/


        $scope.foo = function(note){
            if (note["type_note"] == "task"){
                return "fa-tasks";
            }
            if (note["type_note"] == "deadline"){
                return "fa-calendar";
            }
            if (note["type_note"] == "remark"){
                return "fa-pencil";
            }
            if (note["type_note"] == "call") {
                return "fa-phone";
            }
            if (note["type_note"] == "meeting") {
                return "fa-users";
            }
            if (note["type_note"] == "document") {
                return "fa-file-o";
            }
            if (note["type_note"] == "question") {
                return "fa-question";
            }
            if (note["type_note"] == "idea"){
                return "fa-lightbulb-o";
            }
            if (note["type_note"] == "customer"){
                return  "fa-handshake-o";
            }
            if (note["type_note"] == "picture"){
                return "fa-camera";
            }
            if (note["type_note"] == "mail"){
                return "fa-envelope-o";
            }
            if (note["type_note"] == "danger"){
                return "fa-exclamation-triangle";
            }

        }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $scope.delete_note = function (id_note) {
            if ( id_note ){
            //console.log($scope.delete);
            console.log(id_note);
            var modalInstance = $uibModal.open({


                animation: true,
                templateUrl: '/assets/angular/popupModalDeBase.html',
                controller: 'ZeAppsPopupModalDeBaseCtrl',
                size: 'lg',
                resolve: {
                    titre: function () {
                        return 'Attention';
                    },
                    msg: function () {
                        return 'Souhaitez-vous supprimer définitivement cette note ?';
                    },
                    action_danger: function () {
                        return 'Annuler';
                    },
                    action_primary: function () {
                        return false;
                    },
                    action_success: function () {
                        return 'Je confirme la suppression';
                    }

                }

            });

            /********** Send the Http request to the Php controller and reload projects **********/

            modalInstance.result.then(function (selectedItem) {
                if (selectedItem.action == 'danger') {

                } else if (selectedItem.action == 'success') {
                    // console.log(workload_id);
                    $http.get('/meeting_app/subject/deleteNote/' + id_note).then(function (response) {
                        if (response.status == 200) {
                            loadNotes() ;
                        }
                    });
                }

            }, function () {
                    //console.log("rien");

                });
            }

        };


        $scope.edition_encours_global = false ;
        $scope.edit_note = function (note) {
            if ($scope.edition_encours_global == false) {
                note.edition_encours = true;
                note.description_edit = note.description;

                $scope.edition_encours_global = true;
            }
        };
        
        $scope.save_note = function (note, $event) {
            note.edition_encours = false ;
            $event.stopPropagation();
            var data = {};

            if ($routeParams.id_meet && $routeParams.id_meet != 0 && $routeParams.id_project && $routeParams.id_project != 0 ) {
                data.id_meet = $routeParams.id_meet;
                data.id_project = $routeParams.id_project;
            }



            data.id = note.id;
            data.description = note.description_edit;
            data.type_note = note.type_note;

            $http.post('/meeting_app/subject/saveNote', angular.toJson(data)).then(function (obj) {

                note.id = obj.data.id;
                note.description = note.description_edit;
                console.log(obj.data);


            });

            $scope.edition_encours_global = false ;
        };

        $scope.cancel_note = function (note, $event) {
            note.edition_encours = false ;
            $event.stopPropagation();

            $scope.edition_encours_global = false ;
        };





    }]);



