<div class="modal modal-danger fade"
                    id="modal-update-record"
                    tabindex="-1"
                    role="dialog"
                    aria-labelledby="myModalLabel"
                    aria-hidden="true">
             <div class="modal-dialog">
                     <div class="modal-content">
                             <div class="modal-header">
                                 <h4><i class="icon fa fa-ban"></i><span id="modal-confirm-title">Alert!</span></h4>
                             </div>
                             <div class="modal-body">
                                 <h4 id="record-info"></h4>
                                 <p id="record-id"></p>
                             </div>
                             <div class="modal-footer">
                                 {{ Form::open(
                                        [ 'url'=>'api/magazine/saveas',
                                        'method'=>'post',
                                        'id'=>'update_record'
                                        ])
                                    }}
                                    {!! Form::hidden('id', '', ['id' => 'hidden-id']) !!}
                                    {!! Form::hidden('story_ids', '', ['id' => 'story-ids']) !!}
                                    <input type="hidden" name="_method" id="_method" value="POST">
                                    <button type="button" class="btn btn-outline pull-right" id="btn-confirm-saveas">Save As</button>
                                    {{-- {!! Form::submit('Yes, delete this announcement!', ['class' => 'button alert', 'id'=> 'btn-confirm-delete']) !!} --}}
                                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>

                                 {!! Form::close() !!}
                            </div><!-- /.modal-footer -->
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
