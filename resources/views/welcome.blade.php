<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @auth
        <!-- API Token -->
        <meta name="api-token" content="{{ auth()->user()->api_token }}">
        @endauth

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
    <body class="antialiased container">

        {{-- TOP BAR - NAVBAR --}}
        <nav class="navbar navbar-expand-lg bg-light border-bottom">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">GITE NC</a>
            </div>
          </nav>

        {{-- FIRST CONTENT - Présentation --}}
        <div class="my-5 p-5 bg-light">
            <div class="container">
                <h1 class="display-3">Gite NC</h1>
                <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, iure nostrum. Necessitatibus iure fugit consequuntur aliquid tempora doloremque, animi voluptates totam perspiciatis expedita, itaque facilis eius consequatur enim accusamus saepe!</p>
            </div>
        </div>

        <div class="row mx-0 my-5">
            <h2 class="pb-3 text-center">Nos Chambres</h2>
            <div class="d-flex justify-content-around">
                <div class="text-center">
                    <img src="https://via.placeholder.com/200" class="rounded" alt="...">
                    <p class="my-2 px-4">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
                <div class="text-center">
                    <img src="https://via.placeholder.com/200" class="rounded" alt="...">
                    <p class="my-2 px-4">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
                <div class="text-center">
                    <img src="https://via.placeholder.com/200" class="rounded" alt="...">
                    <p class="my-2 px-4">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
            <button type="button" class="btn btn-primary w-auto m-auto mt-3 btn-create-modal" data-bs-toggle="modal" data-bs-target="#modalReservation">Réserver une chambre</button>
        </div>

        <div class="modal fade" id="modalReservation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalReservationLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalReservationLabel">Réservez une chambre</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" class="needs-validation" id="formReservation" novalidate>
                        @csrf
                        <div class="row m-0 g-3">
                            <div class="col-6">
                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nom">
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Prénom">
                            </div>
                            <div class="col-6">
                                <input type="phone" class="form-control" id="phone" name="phone" placeholder="N° Téléphone">
                            </div>
                            <div class="col-6">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                            </div>
                            <div class="col-8">
                                <input type="date" class="form-control" id="arrival" name="arrival" placeholder="Arrivé prévu sur gite">
                            </div>
                            <div class="col-6">
                                <select class="form-select" class="weeknight" id="weeknight" name="weeknight" autocomplete="off">
                                    <option value="">Nuits en semaine</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                  </select>
                            </div>
                            <div class="col-6">
                                <select class="form-select" class="weekendnight" id="weekendnight" name="weekendnight" autocomplete="off">
                                    <option value="">Nuits en Week-End</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                  </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                  <button type="button" class="btn btn-primary" id="submitForm">Réserver</button>
                </div>
              </div>
            </div>
          </div>

          <div id="formMessage"></div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    
        <script>
            $(document).ready(function() {

                // Comportement du formulaire pour création
                $('.btn-create-modal').click(function () {
                    $('.modal-title').text('Réserver une chambre');
                    $('#formReservation').removeClass('was-validated');
                    $('#submitForm').attr('onclick', 'editReservation()');
                })
            });
        
            /* Comportement de la modal en cas de modification de reservation */
            function modalUpdateReservation(idReservation) {
                $('#modalReservation').modal('show');
                $('.modal-title').text('Modification de réservation de chambre');
                getReservation(idReservation);
            }
        
            /* Récupération des données d'une réservation */
            function getReservation(idReservation) {
                $.ajax({
                    url: '/api/reservations/' + idReservation,
                    type: 'GET',
                    success: function (result) {
                        completeForm(result[0]);
                    }
                })
            }

            /* Édition d'une réservation (création ou modification) */
            function editReservation(idReservation) {
                let url, type;
                
                let firstname = $('input[name=firstname]').val();
                let lastname = $('input[name=lastname]').val();
                let phone = $('input[name=phone]').val();
                let email = $('input[name=email]').val();
                let arrival = $('input[name=arrival]').val();
                let weeknight = $('select[name=weeknight]').val();
                let weekendnight = $('select[name=weekendnight]').val();
        
                if (idReservation) {
                    url = '/api/reservations/' + idReservation;
                    type = 'PUT';
                } else {
                    url = '/api/reservations';
                    type = 'POST';
                }
        
                if (!checkFormValidity('formReservation'))
                    return false;
        
                $.ajax({
                    url: url,
                    type: type,
                    data: {
                        firstname: firstname,
                        lastname: lastname,
                        phone: phone,
                        email: email,
                        arrival: arrival,
                        weeknight: weeknight,
                        weekendnight: weekendnight
                    },
                    success: function (result) {
                        let message = result.success;
                        let registerData = result.data.original;
                        $('#formMessage').html('<div class="container alert alert-success alert-dismissible fade show fixed-bottom mb-2" role="alert">'
                            + '<div class="d-flex justify-content-center align-items-center">'
                            + '<div><h6 id="formResponse" class="m-0">'+ message +'</h6>'
                            + 'Si vous souhaitez apporter des changements à votre réservation, il est possible de la modifié ou la supprimé.</div>'
                            + '<button type="button" class="btn btn-primary btn-update-modal w-auto mx-2" onclick="modalUpdateReservation('+ registerData.id +')">Modifier</button>'
                            + '<button type="button" class="btn btn-danger w-auto" onclick="deleteReservation('+ registerData.id +')">Supprimer</button>'
                            + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>'
                            + '</div>'
                        +'</div>');

                        resetForm();
                    }
                })
            }

            /* Réquête de suppression de reservation */
            function deleteReservation(idReservation) {
                $.ajax({
                    url: '/api/reservations/' + idReservation,
                    type: 'DELETE',
                    success: function (result) {
                        let message = result.success;
                        $('#formMessage').html('<div class="container alert alert-success alert-dismissible fade show fixed-bottom mb-2" role="alert">'
                            + '<div class="d-flex justify-content-center align-items-center">'
                            + '<h6 id="formResponse">'+ message +'</h6>'
                            + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>'
                            + '</div>'
                        +'</div>');
                    }
                })
            }
        
            /* Vérification de la validité du formulaire */
            function checkFormValidity(formId) {
                if (!$('#' + formId)[0].checkValidity()) {
                    $('#' + formId).addClass('was-validated');
                    return false;
                }
        
                $('#' + formId).addClass('was-validated')
                return true;
            }

            /* Completion du formulaire pour modification */
            function completeForm(reservationData) {
                $('#firstname').val(reservationData.firstname);
                $('#lastname').val(reservationData.lastname);
                $('#phone').val(reservationData.phone);
                $('#email').val(reservationData.email);
                $('#arrival').val(reservationData.arrival);
                $('#weeknight').val(reservationData.weeknight);
                $('#weekendnight').val(reservationData.weekendnight);
    
                $('#submitForm').attr('onclick', 'editReservation(' + reservationData.id + ')');
            }

            /* Nettoyage du formulaire */
            function resetForm() {
                $('#formReservation')[0].reset();
                $('#formReservation').removeClass('was-validated');
                $('#modalReservation').modal('hide');
            }
        </script>
    </body>
</html>
