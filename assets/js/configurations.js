function modifySettings(action, name, value) {
    $.ajax({
        url: 'requests/settings.php',
        method: 'POST',
        data: {
            action: action,
            name: name,
            value: value
        }
    });

    return false;
}

function showMiniPanel(title, content, fullscreen) {
    if(fullscreen == true) {
        $('#panel').html('<div class="mini-panel fullscreen"><div class="header">' + title + '<a href="javascript:void(0);" class="mini-panel-close floating-button" style="right: 10px;"><span class="fa fa-close"></span></a></div><div class="body">' + content + '</div></div>');

        $('.mini-panel').fadeIn(250);

        $('.mini-panel-close').click(function() {
            $('.mini-panel').fadeOut(250);
        });
    } else if(fullscreen == false) {
        $('#panel').html('<div class="mini-panel"><div class="header">' + title + '<a href="javascript:void(0);" class="mini-panel-close floating-button" style="right: 10px;"><span class="fa fa-close"></span></a></div><div class="body">' + content + '</div></div>');

        $('.mini-panel').fadeIn(250);

        $('.mini-panel-close').click(function() {
            $('.mini-panel').fadeOut(250);
        });
    } else {
        alert('Error: showMiniPanel()');
    }
}

function alignPanel() {
    $('.panel').css({
        'margin-top': -($('.panel').height() / 2) + 'px'
    });
}

function manageVoters() {
    showMiniPanel('Voters', '<div id="list-pane"><ul id="voters-list-pane" class="list-pane"></ul></div><div id="voters-panel-content" class="panel-content"></div>', true);
    alignPanel();

    $.ajax({
        url: 'requests/settings.php',
        method: 'POST',
        data: {
            action: '1f6d2bc8ff9d746760a20ff5c4bc4c6d'
        },
        success: function(response) {
            $('#voters-list-pane').html(response);

            $('[data-add-party]').click(function() {
                $.ajax({
                    url: 'requests/settings.php',
                    method: 'POST',
                    data: {
                        action: '118847e23fd5212c65a4c9acfeab3b67'
                    },
                    success: function(response) {
                        $('#parties-panel-content').html(response);

                        $('#add-party-form').submit(function() {
                            $.ajax({
                                url: 'requests/settings.php',
                                method: 'POST',
                                data: $(this).serialize() + '&action=25cb56b003b48e4e428202cc62042139',
                                success: function(response) {
                                    manageParties();
                                }
                            });

                            return false;
                        });
                    }
                });

                return false;
            });

            $('[data-remove-party]').click(function() {
                $.ajax({
                    url: 'requests/settings.php',
                    method: 'POST',
                    data: {
                        action: '7895fd6c3b57178f1a6fee21174197b1',
                        party: $(this).data('remove-party')
                    },
                    success: function(response) {
                        manageParties();
                    }
                });

                return false;
            });

            $('[data-party]').click(function() {
                $.ajax({
                    url: 'requests/settings.php',
                    method: 'POST',
                    data: {
                        action: '418367f06b5e815a83792d394d4596d7',
                        party: $(this).data('party')
                    },
                    success: function(response) {
                        $('#parties-panel-content').html(response);

                        $('#edit-party-form').submit(function() {
                            $.ajax({
                                url: 'requests/settings.php',
                                method: 'POST',
                                data: $(this).serialize() + '&action=c96f2cae42ea1a2521b04b14bf6cd3b5',
                                success: function(response) {
                                    manageParties();
                                }
                            });

                            return false;
                        });
                    }
                });

                return false;
            });
        }
    });

    return false;
}

function manageCandidates() {
    showMiniPanel('Candidates', '<div id="list-pane"><ul id="candidates-list-pane" class="list-pane"></ul></div><div id="candidates-panel-content" class="panel-content"></div>', true);
    alignPanel();

    $.ajax({
        url: 'requests/settings.php',
        method: 'POST',
        data: {
            action: '03e844f44b581835d307877c455b207f'
        },
        success: function(response) {
            $('#candidates-list-pane').html(response);

            $('[data-add-candidate]').click(function() {
                $.ajax({
                    url: 'requests/settings.php',
                    method: 'POST',
                    data: {
                        action: 'cfb690cd9bbba317440e769fa9dda774'
                    },
                    success: function(response) {
                        $('#candidates-panel-content').html(response);

                        $('#add-candidate-form').submit(function() {
                            $.ajax({
                                url: 'requests/settings.php',
                                method: 'POST',
                                data: $(this).serialize() + '&action=e97d895f04a8ca16911bd1b57b7e0887',
                                success: function(response) {
                                    manageCandidates();
                                }
                            });

                            return false;
                        });
                    }
                });

                return false;
            });

            $('[data-remove-candidate]').click(function() {
                $.ajax({
                    url: 'requests/settings.php',
                    method: 'POST',
                    data: {
                        action: '173e37e4d03ef74196b28688770c6822',
                        candidate: $(this).data('remove-candidate')
                    },
                    success: function(response) {
                        manageCandidates();
                    }
                });

                return false;
            });

            $('[data-candidate]').click(function() {
                $.ajax({
                    url: 'requests/settings.php',
                    method: 'POST',
                    data: {
                        action: 'fbebc45c125f74c4ccbb156bc9a24905',
                        id: $(this).data('candidate')
                    },
                    success: function(response) {
                        $('#candidates-panel-content').html(response);

                        $('#edit-candidate-form').submit(function() {
                            $.ajax({
                                url: 'requests/settings.php',
                                method: 'POST',
                                data: $(this).serialize() + '&action=a305c4539e938faa06f1f369c8753c1d',
                                success: function(response) {
                                    manageCandidates();
                                }
                            });

                            return false;
                        });
                    }
                });

                return false;
            });
        }
    });

    return false;
}

function manageParties() {
    showMiniPanel('Parties', '<div id="list-pane"><ul id="parties-list-pane" class="list-pane"></ul></div><div id="parties-panel-content" class="panel-content"></div>', true);
    alignPanel();

    $.ajax({
        url: 'requests/settings.php',
        method: 'POST',
        data: {
            action: '4bf9470e08c49d6a2f21061be0fa075e'
        },
        success: function(response) {
            $('#parties-list-pane').html(response);

            $('[data-add-party]').click(function() {
                $.ajax({
                    url: 'requests/settings.php',
                    method: 'POST',
                    data: {
                        action: '118847e23fd5212c65a4c9acfeab3b67'
                    },
                    success: function(response) {
                        $('#parties-panel-content').html(response);

                        $('#add-party-form').submit(function() {
                            $.ajax({
                                url: 'requests/settings.php',
                                method: 'POST',
                                data: $(this).serialize() + '&action=25cb56b003b48e4e428202cc62042139',
                                success: function(response) {
                                    manageParties();
                                }
                            });

                            return false;
                        });
                    }
                });

                return false;
            });

            $('[data-remove-party]').click(function() {
                $.ajax({
                    url: 'requests/settings.php',
                    method: 'POST',
                    data: {
                        action: '7895fd6c3b57178f1a6fee21174197b1',
                        party: $(this).data('remove-party')
                    },
                    success: function(response) {
                        manageParties();
                    }
                });

                return false;
            });

            $('[data-party]').click(function() {
                $.ajax({
                    url: 'requests/settings.php',
                    method: 'POST',
                    data: {
                        action: '418367f06b5e815a83792d394d4596d7',
                        party: $(this).data('party')
                    },
                    success: function(response) {
                        $('#parties-panel-content').html(response);

                        $('#edit-party-form').submit(function() {
                            $.ajax({
                                url: 'requests/settings.php',
                                method: 'POST',
                                data: $(this).serialize() + '&action=c96f2cae42ea1a2521b04b14bf6cd3b5',
                                success: function(response) {
                                    manageParties();
                                }
                            });

                            return false;
                        });
                    }
                });

                return false;
            });
        }
    });

    return false;
}

function manageSystemSettings() {
    showMiniPanel('System Settings', '<div class="election-status"></div><table class="table"><tbody><tr><td width="50%" align="right">Status:</td><td><button id="status-play-button" class="input-button minify flatten round" title="Play"><span class="fa fa-play"></span></button>&nbsp;<button id="status-pause-button" class="input-button minify flatten round" title="Pause"><span class="fa fa-pause"></span></button>&nbsp;<button id="status-stop-button" class="input-button minify flatten round" title="Stop"><span class="fa fa-stop"></span></button></td></tr></tbody></table>', false);
    alignPanel();

    $.ajax({
        url: 'requests/settings.php',
        method: 'POST',
        data: {
            action: 'dee3906666c987ddc8d7d4162de73b79'
        },
        success: function(response) {
            $('.election-status').html(response);

            $('#status-play-button').click(function() {
                modifySettings('03a66ac2fcff279daee5381e88a153ce', 'status', '1');

                manageSystemSettings();
            });

            $('#status-pause-button').click(function() {
                modifySettings('03a66ac2fcff279daee5381e88a153ce', 'status', '2');

                manageSystemSettings();
            });

            $('#status-stop-button').click(function() {
                modifySettings('03a66ac2fcff279daee5381e88a153ce', 'status', '3');

                manageSystemSettings();
            });
        }
    });

    return false;
}

$(document).ready(function() {
    $('#voters-menu-item').click(function() {
        manageVoters();
    });

    $('#candidates-menu-item').click(function() {
        manageCandidates();
    });

    $('#parties-menu-item').click(function() {
        manageParties();
    });

    $('#database-settings-menu-item').click(function() {
        showMiniPanel('Database Settings', '<table class="table"><tbody><tr><td width="50%" align="right">Host Name:</td><td><input type="text" id="input-hostname" class="input-box left" style="width: 85%;"></td></tr><tr><td width="50%" align="right">Username:</td><td><input type="text" id="input-username" class="input-box left" style="width: 85%;"></td></tr><tr><td width="50%" align="right">Password:</td><td><input type="text" id="input-password" class="input-box left" style="width: 85%;"></td></tr><tr><td width="50%" align="right">Database Name:</td><td><input type="text" id="input-database" class="input-box left" style="width: 85%;"></td></tr></tbody></table><div class="button-container"><button id="save-changes-button" class="input-button minify">Save Changes</button></div>', false);
        alignPanel();

        $.ajax({
            url: 'requests/settings.php',
            method: 'POST',
            data: {
                action: 'c822c4b90e5af3183c3f4b6b9d4ee923'
            },
            dataType: 'json',
            success: function(response) {
                $('#input-hostname').val(response['hostname']);
                $('#input-username').val(response['username']);
                $('#input-password').val(response['password']);
                $('#input-database').val(response['database']);

                $('#save-changes-button').click(function() {
                    $.ajax({
                        url: 'requests/settings.php',
                        method: 'POST',
                        data: {
                            action: 'd639df32d0594c7f8d91949ce367a9b1',
                            hostname: $('#input-hostname').val(),
                            username: $('#input-username').val(),
                            password: $('#input-password').val(),
                            database: $('#input-database').val()
                        },
                        success: function(response) {
                            alert(response);

                            location.reload();
                        }
                    });

                    return false;
                });
            }
        });

        return false;
    });

    $('#system-settings-menu-item').click(function() {
        manageSystemSettings();
    });
});