<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'/>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
        <meta name='description' content='Sistema de administração eclesiásticas da CIMADSETA'/>
        <meta name='author' content='BemFuncional'/>

        <link rel='shortcut icon' href='{{url('/assets/images/favicon.png')}}' />
        <link href='{{url('/assets/images/favicon.144x144.png')}}' rel='apple-touch-icon' type='image/png' sizes='144x144'/>
        <link href='{{url('/assets/images/favicon.114x114.png')}}' rel='apple-touch-icon' type='image/png' sizes='114x114'/>
        <link href='{{url('/assets/images/favicon.72x72.png')}}' rel='apple-touch-icon' type='image/png' sizes='72x72'/>
        <link href='{{url('/assets/images/favicon.57x57.png')}}' rel='apple-touch-icon' type='image/png'/>
        <link href='{{url('/assets/images/favicon.png')}}' rel='icon' type='image/png'/>
        <link href='{{url('/assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/plugins/tooltipster/tooltipster.bundle.min.css')}}' rel='stylesheet' type='text/css' />
        
        <!-- App css -->
        <link href='{{url('/assets/css/bootstrap.min.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/css/core.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/css/components.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/css/icons.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/css/pages.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/css/menu.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/css/responsive.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/css/app.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/plugins/switchery/switchery.min.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/plugins/toastr/toastr.min.css')}}' rel='stylesheet' type='text/css' />

        
        <!-- DataTables -->
        <link href='{{url('/assets/plugins/datatables/jquery.dataTables.min.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/plugins/datatables/buttons.bootstrap.min.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/plugins/datatables/fixedHeader.bootstrap.min.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/plugins/datatables/responsive.bootstrap.min.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/plugins/datatables/scroller.bootstrap.min.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/plugins/datatables/dataTables.colVis.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/plugins/datatables/dataTables.bootstrap.min.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/plugins/datatables/fixedColumns.dataTables.min.css')}}' rel='stylesheet' type='text/css' />


        
        <!-- forms -->
        <link href='{{url('/assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css')}}'  rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/plugins/multiselect/css/multi-select.css')}}'  rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/plugins/select2/css/select2.min.css')}}' rel='stylesheet' type='text/css' />
        <link href='{{url('/assets/plugins/bootstrap-select/css/bootstrap-select.min.css')}}' rel='stylesheet'  type='text/css'  />
        <link href='{{url('/assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}' rel='stylesheet'  type='text/css' />



        @stack('css')
        @stack('js-topo')


        
        <link href='{{url('/assets/plugins/custombox/css/custombox.min.css')}}' rel='stylesheet' type='text/css' />
        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')}}'></script>
        <script src='https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js')}}'></script>
        <![endif]-->

        <script src='{{url('/assets/js/modernizr.min.js')}}'></script>
            

    </head>


    <body>
        
       
            
                
                @yield('content')

       

        <!-- jQuery  -->
        <script src='{{url('/assets/js/jquery.min.js')}}'></script>
        <script src='{{url('/assets/js/bootstrap.min.js')}}'></script>
        <script src='{{url('/assets/js/detect.js')}}'></script>
        <script src='{{url('/assets/js/fastclick.js')}}'></script>
        <script src='{{url('/assets/js/jquery.blockUI.js')}}'></script>
        <script src='{{url('/assets/js/waves.js')}}'></script>
        <script src='{{url('/assets/js/jquery.slimscroll.js')}}'></script>
        <script src='{{url('/assets/js/jquery.scrollTo.min.js')}}'></script>
        <script src='{{url('/assets/plugins/switchery/switchery.min.js')}}'></script>
        <script src='{{url('/assets/js/MascaraValidacao.js')}}'></script>

        <script src='{{url('/assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js')}}'></script>
        <script type='text/javascript' src='{{url('/assets/plugins/multiselect/js/jquery.multi-select.js')}}'></script>
        <script type='text/javascript' src='{{url('/assets/plugins/jquery-quicksearch/jquery.quicksearch.js')}}'></script>
        <script src='{{url('/assets/plugins/select2/js/select2.min.js')}}'type='text/javascript'></script>
        <script src='{{url('/assets/plugins/bootstrap-select/js/bootstrap-select.min.js')}}'type='text/javascript'></script>
        <script src='{{url('/assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')}}'type='text/javascript'></script>
        <script src='{{url('/assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')}}'type='text/javascript'></script>
        <script src='{{url('/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}'type='text/javascript'></script>

        <script src='{{url('/assets/plugins/datatables/jquery.dataTables.min.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/dataTables.bootstrap.js')}}'></script>

        <script src='{{url('/assets/plugins/datatables/dataTables.buttons.min.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/buttons.bootstrap.min.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/jszip.min.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/pdfmake.min.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/vfs_fonts.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/buttons.html5.min.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/buttons.print.min.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/dataTables.fixedHeader.min.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/dataTables.keyTable.min.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/dataTables.responsive.min.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/responsive.bootstrap.min.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/dataTables.scroller.min.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/dataTables.colVis.js')}}'></script>
        <script src='{{url('/assets/plugins/datatables/dataTables.fixedColumns.min.js')}}'></script>
        
        <script src='{{url('/assets/plugins/custombox/js/custombox.min.js')}}'></script>
        <script src='{{url('/assets/plugins/custombox/js/legacy.min.js')}}'></script>

        <script src='{{url('/assets/pages/jquery.sweet-alert.init.js')}}'></script>
        <script src='{{url('/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}'></script>
        
        <script src='{{url('/assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')}}'></script>
        <script src='{{url('/assets/plugins/autoNumeric/autoNumeric.js')}}'></script>

        <script src='{{url('/assets/plugins/toastr/toastr.min.js')}}'></script>
        <script src='{{url('/assets/pages/jquery.toastr.js')}}'></script>

        <!-- Tooltipster js -->
        <script src='{{url('/assets/plugins/tooltipster/tooltipster.bundle.min.js')}}'></script>
        <script src='{{url('/assets/pages/jquery.tooltipster.js')}}'></script>

        <!-- init -->
        <script src='{{url('/assets/pages/jquery.datatables.init.js')}}'></script>
        <script type='text/javascript' src='{{url('/assets/pages/jquery.form-advanced.init.js')}}'></script>

        <!-- App js -->
        <script src='{{url('/assets/js/jquery.core.js')}}'></script>
        <script src='{{url('/assets/js/jquery.app.js')}}'></script>
        
        @stack('js-footer')

        <form id='logout-form' action='{{ url('/logout')}}' method='POST' style='display: none;'>
            {{ csrf_field() }}
        </form>       
        <input type="hidden" id="token" value="{{csrf_token()}}"/>
        
        <script>
            
            $(function () {
                jQuery('#form').submit(function () {
                    var dadosForm = jQuery(this).serialize();
                    jQuery.ajax({
                        url: jQuery(this).attr('form-send'),
                        data: dadosForm,
                        method: 'POST',
                        beforeSend: preloader()
                    }).done(function (data) {
                        if (data == '1') {
                            erase(),
                            $('#modalForm').modal('hide'),
                            swal({
                                title: 'Confirmado!',
                                        text: 'O registro foi salvo com sucesso.',
                                        type: 'success',
                                        closeOnConfirm: true,
                                        confirmButtonClass: 'btn-success',
                                        confirmButtonText: 'Fechar'
                            },
                            function (isConfirm) {
                                if (isConfirm) {
                                    $("#datatable-buttons").load(location.href+" #datatable-buttons>*","");
                                    $("#datatable").load(location.href+" #datatable>*","");
                                    //setTimeout('location.reload();', 1);
                                } else {
                                    $("#datatable-buttons").load(location.href+" #datatable-buttons>*","");
                                    $("#datatable").load(location.href+" #datatable>*","");
                                    //setTimeout('location.reload();', 3000);
                                }
                            });
                        }
                        else {
                            var idAppend = '#label-error-';
                            $.each(data, function (key, value) {
                                var nameDiv = '';
                                var nameDiv = 'label-error-' + key;
                                jQuery('#' + nameDiv).empty();
                                if ($('#' + nameDiv).is(':empty')) {
                                    $(idAppend + key).append(value);
                                        jQuery(idAppend + key).show();
                                        setTimeout(function () {
                                        $('#' + nameDiv).empty();
                                        }, 10000);
                                }
                            });
                        }
                    }).fail(function () {
                        alert('Falha ao enviar dados');
                    }).complete(function () {
                        endPreloader();
                    });
                        return false;
                });
                jQuery('.btn-cadastrar').click(function () {
                    jQuery('#form').attr('form-send', urlAdd);
                        jQuery('#form').attr('action', urlAdd);
                        jQuery('#form').each(function () {
                        this.reset();
                        });
                    });
                });
                
                function edit(urlEditar) {
                    jQuery.getJSON(urlEditar, function (data) {
                        jQuery.each(data, function (key, val) {
                            jQuery(' *[name="' + key + '"] ').val(val);
                        });
                    });
                    jQuery('#modalForm').modal('show');
                    jQuery("#form").attr("form-send", urlEditar);
                    jQuery("#form").attr("action", urlEditar);
                    erase();
//                    jQuery('#form').each(function () {
//                        this.reset();
//                    });
                    return false;
                }
                
                function fot(urlFoto) {
                    jQuery.getJSON(urlFoto, function (data) {
                        jQuery.each(data, function (key, val) {
                            jQuery(' *[name="' + key + '"] ').val(val);
                        });
                    });
                    jQuery('#modalFormFoto').modal('show');
                    jQuery("#form").attr("form-send", urlFoto);
                    jQuery("#form").attr("action", urlFoto);
                    erase();
//                    jQuery('#form').each(function () {
//                        this.reset();
//                    });
                    return false;
                }
                
                
                
                
                
                
                
                
      
                
                
                
                function editEndereco(urlEditEndereco) {
                    jQuery.getJSON(urlEditEndereco, function (data) {
                        jQuery.each(data, function(key, val){
                            jQuery("*[name='"+key+"']").val(val);
                        });

                    });
                    jQuery("#modalFormEndereco form").attr("form-send", urlEditEndereco);
                    jQuery("#modalFormEndereco form").attr("action", urlEditEndereco);
                    jQuery('#modalFormEndereco form').each(function () {
                        this.reset();
                    });
                    return false;
                }
    
                function editDE(urlDE) {
                    jQuery.getJSON(urlDE, function (data) {
                        jQuery.each(data, function(key, val){
                            jQuery("*[name='"+key+"']").val(val);
                        });

                    });
                    jQuery("#modalFormDE form").attr("form-send", urlDE);
                    jQuery("#modalFormDE form").attr("action", urlDE);
                    jQuery('#modalFormDE form').each(function () {
                        this.reset();
                    });
                    return false;
                }
    
                function editDependente(urlDependente) {
                    jQuery.getJSON(urlDependente, function (data) {
                        jQuery.each(data, function(key, val){
                            jQuery("*[name='"+key+"']").val(val);
                        });

                    });
                    jQuery("#modalFormDependente form").attr("form-send", urlDependente);
                    jQuery("#modalFormDependente form").attr("action", urlDependente);
                    jQuery('#modalFormDependente form').each(function () {
                        this.reset();
                    });
                    return false;
                }
    
                function editBank(urlBank) {
                    jQuery.getJSON(urlBank, function (data) {
                        jQuery.each(data, function(key, val){
                            jQuery("*[name='"+key+"']").val(val);
                        });

                    });
                    jQuery("#modalFormBank form").attr("form-send", urlBank);
                    jQuery("#modalFormBank form").attr("action", urlBank);
                    jQuery('#modalFormBank form').each(function () {
                        this.reset();
                    });
                    return false;
                }
                
                
                
    
                function viewDepententes(urlViewDependentes) {
                    $("#dependenteFrame").attr("src",urlViewDependentes);
                    //jQuery("#dependenteFrame").attr("src", 'algumacoisa');
                    return true;
                }
                
//                function viewDepententes(dependenteFrame, url) {
//                    var iframe = $('#' + dependenteFrame);
//                    if ( iframe.length ) {
//                        iframe.attr('src',url);   
//                        return false;
//                    }
//                    return true;
//                }

                

                


                
                function view(urlView) {
                    jQuery.getJSON(urlView, function (data) {
                        jQuery.each(data, function (key, text) {
                            $(' *[id="SPAN_' + key + '"] ').text(text);
                            
                            //alert( key + ": " + text );
                            if(typeof key != "undefined" && key == 'foto') {
                                var foto = "/assets/users/" + text;
                                
                                $('#fotoImg').attr('src', foto);
                                
                                if(text==null || text=='') {
                                    var foto = "/assets/users/not_img.jpg";
                                    $('#fotoImg').attr('src', foto);
                                } 
                            } 
                        });
                    });
                    return false;
                }
                

                function deletar(urlDeletar) {
                    jQuery("#urlDeletar").val(urlDeletar);
                    swal({
                        title: "Deseja deletar?",
                            text: "Após exclusão você não será capaz de recuperar este arquivo.",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonClass: "btn red",
                            confirmButtonText: "Sim, remova!",
                            cancelButtonClass: "btn white",
                            cancelButtonText: "Cancelar",
                            closeOnConfirm: false,
                            closeOnCancel: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            erase();
                            var urlDeletar = jQuery("#urlDeletar").val();
                            var csrf = jQuery("#token").val();
                            jQuery.ajax({
                                url: urlDeletar,
                                method: 'POST',
                                data: {'_token': csrf},
                                beforeSend: preloader()
                            }).done(function (data) {
                                if (data == "1") {
                                    swal({
                                        title: "Excluido!",
                                        text: "Seu arquivo foi excluído com sucesso!",
                                        type: "success",
                                        confirmButtonClass: "btn-success"
                                    });
                                    $("#datatable-buttons").load(location.href+" #datatable-buttons>*","");
                                    $("#datatable").load(location.href+" #datatable>*","");
                                    //setTimeout('location.reload();', 1500);
                                } else {
                                    jQuery(".errors-msg-delete").html(data);
                                    jQuery(".errors-msg-delete").show();
                                }
                            }).fail(function () {
                                alert('Falha deletar arquivo.');
                            }).complete(function () {
                                endPreloader();
                            });
                        } else {
                            swal({
                                title: "Cancelado!",
                                text: "Seu arquivo está seguro.",
                                type: "error",
                                confirmButtonClass: "btn red"
                            });
                        }
                    });
                }
                

    
    



                function preloader() {
                    $("#preloader").append("<div class='progress progress-md'><div class='progress-bar progress-bar-pink' role='progressbar' aria-valuenow='5' aria-valuemin='0' aria-valuemax='100' style='width: 5%;'>5%</div></div>");
                }
                function endPreloader() {
                    $("#preloader").append("<div class='progress progress-md'><div class='progress-bar progress-bar-pink' role='progressbar' aria-valuenow='98' aria-valuemin='0' aria-valuemax='100' style='width: 98%;'>98%</div></div>");
                }

                function erase() {
                    $('#form').each(function () {
                        this.reset();
                    });
                }
                
                $(document).ready(function () {
                    $('#datatable').dataTable();
                    $("#close").click(function (){
                        $('#form').removeAttr('action');
                        $('#form').removeAttr('form-send');
                        $('#form').removeAttr('selected');
                    });
                });
                
                $(window).load(function() {
                    $("label").removeClass();
                    $("label").addClass("active");
                    
                });

               
                
        </script>
        
        
        <script type="text/javascript">
            $(document).ready(function () {
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable({keys: true});
                $('#datatable-responsive').DataTable();
                $('#datatable-colvid').DataTable({
                    "dom": 'C<"clear">lfrtip',
                    "colVis": {
                        "buttonText": "Change columns"
                    }
                });
                $('#datatable-scroller').DataTable({
                    ajax: "../plugins/datatables/json/scroller-demo.json",
                    deferRender: true,
                    scrollY: 380,
                    scrollCollapse: true,
                    scroller: true
                });
                var table = $('#datatable-fixed-header').DataTable({fixedHeader: true});
                var table = $('#datatable-fixed-col').DataTable({
                    scrollY: "300px",
                    scrollX: true,
                    scrollCollapse: true,
                    paging: false,
                    fixedColumns: {
                        leftColumns: 1,
                        rightColumns: 1
                    }
                });
            });
            TableManageButtons.init();

        </script>
        <script type="text/javascript">
		  jQuery(function($) {
		      $('.autonumber').autoNumeric('init');
		  });
        </script>



    </body>
</html>