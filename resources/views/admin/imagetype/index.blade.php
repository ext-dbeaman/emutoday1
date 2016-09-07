@extends('admin.layouts.adminlte')

@section('title', 'ImageType')

    @section('content')
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header">
									<h3 class="box-title">ImageTypes</h3>
									@include('admin.layouts.components.boxtools', ['rte' => 'imagetype', 'path' => 'admin/imagetype'])

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
											@foreach($imagetypes as $imagetype)
					                <tr>
														<td>
																{{ $imagetype->id }}
														</td>
														  <td>{{ $imagetype->group }}</td>
															<td>{{ $imagetype->type }}</td>
															<td>{{ $imagetype->name }}</td>
															<td>{{ $imagetype->width }}</td>
															<td>{{ $imagetype->height }}</td>
					                    <td>
					                        <a href="{{ route('admin.imagetype.edit', $imagetype->id) }}">
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
