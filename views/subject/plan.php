<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb"><a href="/ng/meeting_app/project/plan" i8n="Projet > "></a><span i8n="Réunion > "></span><span i8n="Sujets"></span></div>

<div id="content">
    <div class="row" >
            <div class="col-md-12  text-center meetingapp-min-font">
                <div  class="col-md-1 ">
                    <i class="fa fa-tasks fa-3x meetingapp-circle" ng-model="task" ng-click="createNote('task')"  aria-hidden="true"></i><br/>
                    Tâche
                </div>
                <div class="col-md-1 ">
                    <i class="fa fa-calendar fa-3x meetingapp-circle" ng-model="deadline" ng-click="createNote('deadline')" aria-hidden="true"></i><br/>
                    Echéance
                </div>
                <div class="col-md-1 ">
                    <i class="fa fa-pencil fa-3x meetingapp-circle" ng-model="remark" ng-click="createNote('remark')" aria-hidden="true"></i><br/>
                    Remarque
                </div>
                <div class="col-md-1">
                    <i class="fa fa-phone fa-3x meetingapp-circle" ng-model="call" ng-click="createNote('call')" aria-hidden="true"></i><br/>
                    Appel
                </div>
                <div class="col-md-1">
                    <i class="fa fa-users fa-3x meetingapp-circle" ng-model="meeting" ng-click="createNote('meeting')" aria-hidden="true"></i><br/>
                    Réunion
                </div>
                <div class="col-md-1">
                    <i class="fa fa-file-o fa-3x meetingapp-circle" ng-model="document" ng-click="createNote('document')" aria-hidden="true"></i><br/>
                    Document
                </div>
                <div class="col-md-1">
                    <i class="fa fa-question fa-3x meetingapp-circle" ng-model="question" ng-click="createNote('question')" aria-hidden="true"></i><br/>
                    Question
                </div>
                <div class="col-md-1">
                    <i class="fa fa-lightbulb-o fa-3x meetingapp-circle" ng-model="idea" ng-click="createNote('idea')" aria-hidden="true"></i><br/>
                    Idée
                </div>
                <div class="col-md-1">
                    <i class="fa fa-handshake-o fa-3x meetingapp-circle" ng-model="customer" ng-click="createNote('customer')" aria-hidden="true"></i><br/>
                    Client
                </div>
                <div class="col-md-1">
                    <i class="fa fa-camera fa-3x meetingapp-circle" ng-model="picture" ng-click="createNote('picture')" aria-hidden="true"></i><br/>
                    Photo
                </div>
                <div class="col-md-1">
                    <i class="fa fa-envelope-o fa-3x meetingapp-circle" ng-model="mail" ng-click="createNote('mail')" aria-hidden="true"></i><br/>
                    Mail
                </div>
                <div class="col-md-1">
                    <i class="fa fa-exclamation-triangle fa-3x meetingapp-circle" ng-model="danger" ng-click="createNote('danger')" aria-hidden="true"></i><br/>
                    Danger
                </div>
            </div>

    </div>

        <div class="row meetingapp-top-margin">

            <h1 class="text-center">{{project.name | uppercase}} : {{meet.name}}</h1>
            <div class="col-md-3 meetingapp-left-menu ">
                <div class="col-md-12 meetingapp-subtitle">
                    <strong i8n="Ordre du jour"></strong><i class="fa fa-plus pull-right" ng-click="addSubject()" style="margin-top: 3px" aria-hidden="true"></i>
                </div>
                <div class=" col-md-12 meetingapp-scroll">
                    <ul>
                        <li ng-repeat="subject in subjects"><i class="fa fa-trash pull-right" aria-hidden="true" ng-click="delete_subject(subject.id)"></i><strong>{{subject.name | uppercase}}</strong> </li>
                    </ul>
                </div>


                <br/>
                <div class="col-md-12 meetingapp-subtitle">
                    <strong i8n="Participants"></strong><i class="fa fa-plus pull-right" ng-click="addParticipant()" style="margin-top: 3px" aria-hidden="true"></i>
                </div>
                <div class="col-md-12 meetingapp-scroll">
                    <ul>
                        <li><strong>L. Desrues</strong></li>
                        <li><strong>T. Sauques</strong></li>
                        <li><strong>N. Ramel</strong></li>
                        <li><strong>JM. Badin</strong></li>
                    </ul>
                </div>

            </div>

            <div class="col-md-9  meetingapp-task">
                    <table class="table">

                            <tr ng-repeat="note in notes" class="col-md-12" ng-click="edit_note(note)">
                                <td>
                                    <span class="fa fa-2x note-circle" ng-class="foo(note)"></span>
                                </td>
                                <td class="meetingapp-textarea col-md-9">
                                    <div ng-show="note.edition_encours == true">
                                        <textarea input="text" {{note.id ? 'autofocus' : ''}}  ng-model="note.description_edit"></textarea><br>
                                        <button class="btn btn-success btn-sm" ng-click="save_note(note, $event)">Enregistrer</button>
                                        <button class="btn btn-warning btn-sm" ng-click="cancel_note(note, $event)">Annuler</button>
                                    </div>
                                    <div ng-show="note.edition_encours == false || note.edition_encours == undefined">
                                        {{ note.description }}
                                    </div>
                                </td>
                                <td class="col-md-1">
                                    <i class="fa fa-check fa-2x" aria-hidden="true"></i>
                                    <i class="fa fa-trash fa-2x" ng-click="delete_note(note.id)" aria-hidden="true"></i>
                                </td>
                            </tr>


                    </table>

            </div>
        </div>



</div>





