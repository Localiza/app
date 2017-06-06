@extends('layouts.general')

@section('content')
    <section class="result">
        <div class="container" style="padding-top: 0; margin-top: 0;">
            <div class="row" style="padding-top: 0; margin-top: 0;">
                <div class="col-xs-12 col-sm-12 col-md-8">
                    <div class="col-md-12 title" style="padding: 0;">
                        <h2 class="">Resultados da pesquisa <small>Foram encontrada(s) <strong>{{ $todas->total()+count($destaques) }}</strong> empresa(s)</small></h2>
                    </div>
                    <hr>
                    <div class="col-xs-12 col-sm-12 col-md-12" style="padding: 0;">
                        <!-- DESTAQUES -->
                        @foreach($destaques as $item)
                            <article class="featured">
                                <img src="{!! asset("uploads/empresas/".$item->logo) !!}" alt="" title="" width="250" height="150">
                                <h2>{{$item->name}}</h2>
                                <p>
                                    {{ $item->logradouro_id ? $item->rua['name']." - " :""  }}
                                    {{ $item->bairro_id ? $item->bairro['name']." - " :""  }}
                                    {{ $item->cep_id  ? $item->cep['name']." - " :""  }}
                                    {{ $item->cidade->name }}/{{ $item->uf->uf }}
                                </p>
                                <p><b>Fone:</b> {{$item->phone1}}{!! $item->phone2 ? " / $item->phone2" :""  !!}</p>
                                {!! $item->email ? "<p><b>E-mail: </b><a href=\"#sendMail\" data-toggle=\"modal\" data-nome=\"$item->name\" data-empresa=\"$item->id\" data-email=\"$item->email\">$item->email</a></p>" :""  !!}
                                {!! $item->website ? "<p><b>Site: </b><a target='_blank' href='http://$item->website'>$item->website</a></p>" :""  !!}
                                <p>
                                    <a href="{{$item->facebook}}" target="_blank"><button type="button" class="btn btn-default"><i class="fa fa-facebook"></i> </button></a>
                                    <button class="btn btn-default"><i class="fa fa-twitter"></i> </button>
                                    <button class="btn btn-default"><i class="fa fa-google-plus"></i> </button>
                                </p>

                            </article>
                            <hr>
                        @endforeach
                        <!-- END DESTAQUES -->

                        <!-- LISTA DE RESULTADOS -->
                        @foreach($todas as $item)
                            <article class="company">
                                <h2>{{ ($item->name)}}</h2>
                                <p>
                                    {{ $item->logradouro_id ? $item->rua['name']." - " :""  }}
                                    {{ $item->bairro_id ? $item->bairro['name']." - " :""  }}
                                    {{ $item->cep_id  ? $item->cep['name']." - " :""  }}
                                    {{ $item->cidade->name }}/{{ $item->uf->uf }}
                                </p>
                                <div class="pull-right telefones">
                                    <span class="complete_phone_{{$item->id}} maskPhone{{$item->id}} hide telefone{{$item->id}}">{{$item->phone1}}</span>
                                    <strong class="phone_{{$item->id}}  telefone{{$item->id}}">Fone: <span class="maskPhone{{$item->id}}">{!! substr($item->phone1,0,7) !!}</span></strong>
                                    <button class="show_phone" onclick='show_phone({{$item->id}}); hide_button(this)'>Ver Telefone</button>
                                </div>
                            </article>
                            <hr>
                        @endforeach
                        <!-- END LISTA DE RESULTADOS -->

                        {!! $todas->appends(Request::only('_token'))
                                    ->appends(Request::only('cidade'))
                                    ->appends(Request::only('busca'))
                                    ->appends(Request::only('send'))
                                    ->render() !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 sponsors">
                    <h2>Anúncios relacionados</h2>
                    @foreach($banners as $item)
                        <article><img src="{!! asset("uploads/empresas/banners/".$item->imagem) !!}" alt="" class="img-responsive"  width="350" height="120"></article>
                    @endforeach
                </div>

            </div>
        </div><!-- /container -->
    </section><!-- /result -->

    <div class="modal bounceIn animated" id="sendMail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div class="modal-title" id="myModalLabel">Enviar e-mail</div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::token() !!}
                        <div class="col-md-12">
                            <label>Nome:</label>
                            <input class="form-control" id="modalSendNome" type="text" placeholder="Seu nome completo">
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-6">
                            <label>E-mail:</label>
                            <input class="form-control" id="modalSendEmail" type="email" placeholder="seu@email.com.br">
                        </div>
                        <div class="col-md-6">
                            <label>Telefone:</label>
                            <input class="form-control phone" id="modalSendPhone" type="text" placeholder="(00) 0000-0000">
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12">
                            <label>Mensagem:</label>
                            <textarea class="form-control" id="modalSendText" placeholder="digite sua mensagem"></textarea>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="fecharModal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="saveModal"><i class="fa fa-send"></i> Enviar email</button>
                </div>
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->
    <script>
        var modal_nome
        var modal_email
        var modal_empresa

        $( document ).ready(function() {

            $('#sendMail').on('show.bs.modal', function(e) {

                modal_nome   = $(e.relatedTarget).data('nome');
                modal_email  = $(e.relatedTarget).data('email');
                modal_empresa= $(e.relatedTarget).data('empresa');
                $('#myModalLabel').html("<h3>"+modal_nome+"</h3><p>"+modal_email+"</p>");
            });

            $('#saveModal').on('click', function(e) {

                var data = {
                    _token: $('input[name=_token]').val(),
                    from_name: $('#modalSendNome').val(),
                    from_email: $('#modalSendEmail').val(),
                    from_phone: $('#modalSendPhone').val(),
                    to_empresa: modal_empresa,
                    from_Text: $('#modalSendText').val()
                }

                console.log(data);

                $.ajax({
                    url: "/sendMail",
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    beforeSend: function () {
                      $('#saveModal').html("enviando...");
                    },
                    success: function (rs) {
                        if (rs) {
                            $('#modalSendNome').val("");
                            $('#modalSendEmail').val("");
                            $('#modalSendPhone').val("");
                            $('#modalSendText').val("");
                            $('#saveModal').html("<i class=\"fa fa-send\"></i> Enviar email");
                            $('#fecharModal').click();
                            alert("Email enviado com sucesso!");
                        }
                    }
                });
            });
        });
    </script>
@endsection
