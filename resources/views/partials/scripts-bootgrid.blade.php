<script>
    function alert_template(message)
    {
        return '<div class="content" id="msj-error">' +
                '<div class="alert alert-danger">' +
                '<button class="close" data-dismiss="alert">&times;</button>' +
                        message +
                '</div>' +
                '</div>';
    }

    function button_template(title,url)
    {
        return '<a href="'+url+'" class="btn btn-primary"><i class="fa fa-plus"></i> '+title+'</a>';
    }

    $(function () {
        var es_labels = {
            loading : 'Cargando',
            noResults : 'No se encontraron resultados',
            all : 'Todos',
            refresh : 'Refrescar',
            search : 'Buscar',
            infos : '@{{ctx.start}}-@{{ctx.end}} de @{{ctx.total}}'
        };

        var app_token = '{{ csrf_token() }}';
        var bootgrid_id = 'b0df282a-0d67-40e5-8558-c9e93b7befed';

        /*
         * Tablas
         */
        var tbl_usuarios = $('#tbl-usuarios').bootgrid({
           labels : es_labels,
           ajax : true,
           url : '{{ url('usuarios') }}',
           post : function () {
               return {
                   id : bootgrid_id,
                   '_token' : app_token
               }
           },
           formatters : {
               id : function (column, row) {
                   return '<button class="btn btn-success btn-xs btn-edit" data-id="'+row.id+'"><i class="fa fa-edit"></i></button> ' +
                           '<button class="btn btn-danger btn-xs btn-delete" data-id="'+row.id+'"><i class="fa fa-trash"></i></button>';
               }
           }
       }).on('loaded.rs.jquery.bootgrid', function () {
           tbl_usuarios.find('.btn-edit').click(function (e) {
               e.preventDefault();
               var id = $(this).data('id');
               window.location.href = '{{ url('usuario') }}/' + id + '/edit';
           }).end().find('.btn-delete').click(function (e) {
               e.preventDefault();
               var id = $(this).data('id');
               var url = '{{ url('usuario') }}/' + id + '/delete';
               var data = {
                 '_token' : app_token
               };
               var pregunta = confirm('¿Está seguro de eliminar este registro?');

               if(pregunta){
                   $.post(url,data)
                           .success(function (result) {
                               tbl_usuarios.bootgrid('reload');
                               console.log(result);
                               var html_msg = alert_template(result.message);
                               tbl_usuarios.on('loaded.rs.jquery.bootgrid',function(){
                                   $('#message').html(html_msg);
                               });

                           });
               }
           });
       });

        var tbl_roles = $('#tbl-roles').bootgrid({
            labels : es_labels,
            ajax : true,
            url : '{{ url('roles') }}',
            post: function () {
                return {
                    id : bootgrid_id,
                    '_token' : app_token
                }
            },
            formatters: {
                id: function (column,row) {
                    return '<button class="btn btn-success btn-xs btn-edit" title="Editar '+row.display_name+'" data-id="'+row.id+'"><i class="fa fa-edit"></i></button> ' +
                            '<button class="btn btn-danger btn-xs btn-delete" title="Eliminar '+row.display_name+'" data-id="'+row.id+'"><i class="fa fa-trash"></i></button> ' +
                            '<button class="btn btn-primary btn-xs btn-attach-perms" title="Asignar permisos" data-id="'+row.id+'"><i class="fa fa-wrench"></i></button>';
                }
            }
        }).on('loaded.rs.jquery.bootgrid', function () {
            tbl_roles.find('.btn-edit').click(function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                window.location.href = '{{ url('rol') }}/' + id + '/edit';
            });
            tbl_roles.find('.btn-delete').click(function (e){
                e.preventDefault();
                var id = $(this).data('id');
                var url = '{{ url('rol') }}/' + id + '/delete';
                var data = { '_token' : app_token};
                var pregunta = confirm('¿Está seguro de eliminar este registro?');

                if(pregunta){
                    $.post(url,data)
                            .success(function (result) {
                                tbl_roles.bootgrid('reload');
                                tbl_roles.on('loaded.rs.jquery.bootgrid', function () {
                                    var message = alert_template(result.message);
                                    $('#message').html(message);
                                });
                            })
                            .error(function (error) {
                                console.log(error);
                            });
                }
            });
            tbl_roles.find('.btn-attach-perms').click(function () {
               var id = $(this).data('id');
                window.location.href = '{{ url('rol') }}/' + id + '/attachperms';
            });
        });

        var tbl_permisos = $('#tbl-permisos').bootgrid({
            labels : es_labels,
            ajax: true,
            url: '{{ url('permisos') }}',
            post: function () {
                return {
                    id: bootgrid_id,
                    '_token' : app_token
                }
            },
            formatters: {
                id: function (column, row) {
                    return '<button class="btn btn-xs btn-success btn-edit" title="Editar permiso '+row.display_name+'" data-id="'+row.id+'"><i class="fa fa-edit"></i></button> ' +
                            '<button class="btn btn-xs btn-danger btn-delete" title="Eliminar permiso '+row.display_name+'" data-id="'+row.id+'"><i class="fa fa-trash"></i></button>';
                }
            }
        }).on('loaded.rs.jquery.bootgrid', function () {
            tbl_permisos.find('.btn-edit').click(function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                window.location.href = '{{ url('permiso') }}/' + id + '/edit';
            });
            tbl_permisos.find('.btn-delete').click(function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var url = '{{ url('permiso') }}/' + id + '/delete';
                var data = { '_token' : app_token };

                var pregunta = confirm('¿Está seguro de eliminar este registro?');

                if(pregunta == true){
                    $.post(url,data)
                            .success(function (result) {
                                tbl_permisos.bootgrid('reload')
                                        .on('loaded.rs.jquery.bootgrid', function () {
                                            var message = alert_template(result.message);
                                            $('#message').html(message);
                                        });
                            })
                            .error(function (error) {
                                console.log(error);
                            });
                }
            });
        });

        var tbl_clientes = $('#tbl-clientes').bootgrid({
            labels : es_labels,
            ajax: true,
            url : '{{ url('clientes') }}',
            post: function () {
                return {
                    '_token' : app_token,
                    id : bootgrid_id
                }
            },
            formatters: {
                id: function (column,row) {
                    return '<button class="btn btn-xs btn-success btn-edit" title="Editar cliente" data-id="'+row.id+'"><i class="fa fa-edit"></i></button> ' +
                            '<button class="btn btn-xs btn-primary btn-asociados btn-icon" title="Ver asociados" data-id="'+row.id+'"><i class="icon-users"></i></button>';
                },
                nombre : function (column,row) {
                    return row.primer_nombre + ' ' + row.segundo_nombre + ' ' + row.primer_apellido + ' ' + row.segundo_apellido
                }
            }
        }).on('loaded.rs.jquery.bootgrid', function () {
            $('.actionBar').append('<div id="btn-add" class="pull-left"></div>');
            var url = '{{ route('cliente.create') }}';
            var button = button_template('Nuevo',url);
            $('#btn-add').html(button);

            tbl_clientes.find('.btn-edit').click(function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                window.location.href = '{{ url('cliente') }}/' + id + '/edit';
            });

            tbl_clientes.find('.btn-asociados').click(function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                window.location.href = '{{ url('cliente') }}/' + id + '/asociados';
            });
        });

        var tbl_preguntas = $('#tbl-preguntas').bootgrid({
            labels: es_labels,
            ajax : true,
            url : '{{ url('preguntas') }}',
            post: function () {
                return {
                    id : bootgrid_id,
                    '_token' : app_token
                };
            },
            formatters: {
                id : function (column, row) {
                    return '<button class="btn btn-success btn-xs btn-edit" title="Editar '+row.pregunta+'" data-id="'+row.id+'"><i class="fa fa-edit"></i></button> ' +
                            '<button class="btn btn-danger"></button>';
                }
            }

        }).on('loaded.rs.jquery.bootgrid', function () {

        });

        var tbl_tipo_pregunta = $('#tbl-tipo-pregunta').bootgrid({
            labels : es_labels,
            ajax: true,
            url : '{{ url('tipos_preguntas') }}',
            post : function () {
                return {
                    '_token' : app_token,
                    id : bootgrid_id
                }
            },
            formatters: {
                id : function (column, row) {
                    return '<button class="btn btn-success btn-xs btn-edit" title="Editar '+row.descripcion+'" data-id="'+row.id+'"><i class="fa fa-edit"></i></button> ' +
                            '<button class="btn btn-danger btn-xs btn-delete" title="Eliminar '+row.descripcion+'" data-id="'+row.id+'"><i class="fa fa-trash"></i></button>';
                }
            }
        }).on('loaded.rs.jquery.bootgrid', function () {
            var btn = '<div class="pull-left">' +
                    button_template('Nuevo','{{ route('tipo_pregunta.create') }}') +
                    '</div>';
            $('.actionBar').append('<div class="pull-left" id="btn-add"></div>');
            $('#btn-add').html(btn);

            tbl_tipo_pregunta.find('.btn-edit').click(function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                window.location.href = '{{ url('tipo_pregunta') }}/' + id + '/edit';
            });

            tbl_tipo_pregunta.find('.btn-delete').click(function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var url = '{{ url('tipo_pregunta') }}/' + id + '/delete';
                var data = { '_token' : app_token };
                var confirma = confirm('¿Está seguro de querer eliminar este registro?');
                var contador = 0;

                if(confirma){
                    $.post(url,data)
                            .success(function (result) {
                                tbl_tipo_pregunta.bootgrid('reload')
                                        .on('loaded.rs.jquery.bootgrid', function () {
                                            contador++;
                                            if(contador == 1){
                                                var msj = alert_template(result.message);
                                                $('#mensaje').html(msj);
                                                $('#msj-error').fadeOut(5000, function () {
                                                    $('#msj-error').remove();
                                                });
                                            }
                                });
                            })
                            .error(function (error) {
                                console.log(error);
                            });
                }
            });
        });

        var cliente_id = $('#tbl-asociados').data('cliente-id');

        var tbl_asociados = $('#tbl-asociados').bootgrid({
            labels : es_labels,
            ajax: true,
            url : '{{ url('asociados') }}/' + cliente_id,
            post: {
                '_token' : app_token,
                id : bootgrid_id
            },
            formatters: {
                id : function (column, row) {
                    return '<button class="btn btn-success btn-xs btn-edit" title="Editar '+row.pregunta+'" data-id="'+row.id+'"><i class="fa fa-edit"></i></button> ';
                }
            }
        }).on('loaded.rs.jquery.bootgrid', function () {
            tbl_asociados.find('.btn-edit').click(function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                window.location.href = '{{ url('asociado') }}/' + id + '/edit';
            });
            var url = '{{ url('asociado/create/cliente') }}/' + cliente_id;
            var btn = button_template('Nuevo',url);


            $('.actionBar').append('<div class="pull-left" id="btn-add"></div>');
            $('#btn-add').html(btn);
        });
    });
</script>