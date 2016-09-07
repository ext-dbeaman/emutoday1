@extends('admin.layouts.adminlte')

@section('title', 'MediaType')

    @section('content')
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header">
									<h3 class="box-title">MediaTypes</h3>
									@include('admin.layouts.components.boxtools', ['rte' => 'mediatype', 'path' => 'admin/mediatype'])

								</div><!-- /.box-header -->
								<div class="box-body table-responsive no-padding">
									<table class="table table-hover table-bordered">
										<tr>
											<th>id</th>
											<th>group</th>
			                <th>type</th>
											<th>name</th>
											<th>width</th>
			                <th>height</th>
											<th>Edit</th>
			                <th>Delete</th>
										</tr>
										<tr>
											@foreach($mediatypes as $mediatype)
					                <tr>
														<td>
																{{ $mediatype->id }}
														</td>
														  <td>{{ $mediatype->group }}</td>
															<td>{{ $mediatype->type }}</td>
															<td>{{ $mediatype->name }}</td>
															<td>{{ $mediatype->width }}</td>
															<td>{{ $mediatype->height }}</td>
					                    <td>
					                        <a href="{{ route('admin.mediatype.edit', $mediatype->id) }}">
																		<i class="fa fa-pencil"></i>

					                        </a>
					                    </td>
					                    <td>
					                        {{-- <a href="{{ route('admin.role.confirm', $role->id) }}">
					                                	<i class="fa fa-trash"></i>
					                        </a> --}}
					                    </td>
					                </tr>
					            @endforeach
										</tr>

									</table>
								</div>
								<!-- /.box-body -->
							</div>
							<!-- /.box -->
						</div>
					</div>
    {{-- {!! $roles->render() !!} --}}

    @endsection
