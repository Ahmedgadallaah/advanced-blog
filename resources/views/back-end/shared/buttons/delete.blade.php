<form action="{{ route($routeName.'.destroy' , ['id' => $row->id] ) }}" method="post" >
                                {{csrf_field()}}
                                {{ method_field('delete') }} 
                                <button type="submit"  rel="tooltip" title="Remove {{$smoduleName}}" class="btn btn-white btn-link btn-sm">
                                        <i class="material-icons">close</i>
                                </button>
                        </form>