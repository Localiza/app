<!-- Modal -->
<div class="modal bounceIn animated" id="addNewRegistersModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Novo Registro</h4>
            </div>
            <div class="modal-body">
                Nome:
                <input class="form-control" placeholder="Digite o nome do novo registro" name="nomeNovo" id="nomeNovo">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="saveModal">SALVAR</button>
            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->

<script>
    var select
    var controller
    var field
    var parent
    var parentField
    var route
    var nome

    $( document ).ready(function() {

        $('#addNewRegistersModal').on('show.bs.modal', function(e) {
            $('#nomeNovo').val("");

            select      = $(e.relatedTarget).data('select-id');
            controller  = $(e.relatedTarget).data('controller-name');
            field       = $(e.relatedTarget).data('field-name');
            parent      = $(e.relatedTarget).data('parent-id');
            parentField = $(e.relatedTarget).data('parent-field');

        });

        $('#saveModal').on('click', function(e) {
            route   = "/createAux";
            nome    = $('#nomeNovo').val();
            if(parent!=-1){
                var parentValue     = $("#"+parent).val();
                route += "/" + controller + "/" + field + "/" + nome + "/" + parentField + "/" + parentValue.toString();
            }else{
                route += "/" + controller + "/" + field + "/" + nome;
            }
            $.ajax({
                url: route,
                type: 'GET',
                dataType: 'json',
                success: function (rs) {
                    var cmp = "#"+select;
                    $(cmp).append('<option value="'+rs.id+'">'+nome+'</option>').val(rs.id);
                    $(cmp).change();
                    $('#addNewRegistersModal').modal('hide');
                }
            });

        });
    });
</script>