<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel WebSocket Example</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        Select an Option
                    </div>
                    <div class="card-body">
                        <form id="option-form">
                            <div class="form-group">
                                <label for="option-select">Options</label>
                                <select class="form-control" id="option-select">
                                    <option value="Option 1">Option 1</option>
                                    <option value="Option 2">Option 2</option>
                                    <option value="Option 3">Option 3</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        document.getElementById('option-form').addEventListener('submit', function(e) {
            e.preventDefault();
            var option = document.getElementById('option-select').value;
            axios.post('/select-option', { option: option });
        });

        if (typeof window.Echo !== 'undefined') {
            window.Echo.channel('options')
                .listen('OptionSelected', (e) => {
                    document.getElementById('selected-option').innerText = e.option;
                });
        } else {
            console.error('Echo is not defined');
        }

        $(document).ready(function(){
            Pusher.logToConsole = true;

            var pusher = new Pusher('93473b84de1b69a82c33', {
                cluster: 'mt1'
            });

            var channel = pusher.subscribe('escrolab_channel1');
            channel.bind('escrolab_messages1', function (response) {
                var optionValue = response.options; // Assuming response.options contains the option value
                // Set the selected option
                $('#option-select').val(optionValue);
            });
        });
    </script>
</body>
</html>
