@extends('layouts.app')

@section('titulo')
    Crea una nueva publicación
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" type="text/css" />
@endpush

@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            {{-- <form action=" {{ route('imagenes.store') }}" id="dropzone" method="POST" enctype="multipart/form-data" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form> --}}

            {{-- <div id="croppie-demo"></div>
            <input type="file" id="upload">
            <button id="crop-btn">Recortar</button>
            <img id="cropped-image" style="display:none;" /> --}}

            <form action="{{ route('imagenes.store') }}" id="dropzone" method="POST" enctype="multipart/form-data"
                class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form>
            <div id="loading"
                class="hidden bg-white border-dashed border-2 w-full h-96 rounded flex-col justify-center items-center">
                <div class="h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-e-transparent"
                    role="status">
                </div>

            </div>
            {{-- <!-- Contenedor para Croppie -->
            <div id="croppie-demo" style="display: none; margin-top: 20px;"></div>
            
            <!-- Botón para recortar y subir la imagen -->
            <button id="crop-btn" style="display: none;">Recortar y Subir</button>
            <img id="cropped-image" style="display:none;" /> --}}

            <!-- Modal -->

            <div id="croppie-modal"
                class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-20">
                <!-- z-50 para asegurar que esté al frente -->
                <div class="relative top-20 mx-auto p-5 border w-3/4 shadow-lg rounded-md bg-white">
                    <h3 class="font-black text-center text-2xl mb-10">Ajusta la imagen</h3>
                    <div id="croppie-demo" class="w-full">
                    </div>
                    <div class="flex justify-center flex-col sm:flex-row">
                        <button id="crop-btn"
                            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full lg:w-1/4 p-3 text-white rounded-lg m-1">Recortar
                            y Subir</button>
                        <button id="close-modal-btn"
                            class="bg-red-500 hover:bg-red-600 transition-colors cursor-pointer uppercase font-bold w-full lg:w-1/4 p-3 text-white rounded-lg m-1">Cerrar</button>
                    </div>
                </div>
            </div>




        </div>
        <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">Titulo</label>
                    <input id="titulo" name="titulo" type="text" placeholder="Titulo de la publicación"
                        class="border p-3 w-full rounded-lg 
                        @error('titulo')
                            border-red-500
                        @enderror"
                        value="{{ old('titulo') }}" />
                    @error('titulo')
                        {{-- <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center font-bold">El nombre es obligatorio</p> --}}
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center font-bold"> {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">Descripción</label>
                    <textarea id="descripcion" name="descripcion" placeholder="Descripción de la publicación"
                        class="border p-3 w-full rounded-lg 
                        @error('descripcion')
                            border-red-500
                        @enderror">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center font-bold"> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="hidden" name="imagen" value="{{ old('imagen') }}" />
                    @error('imagen')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center font-bold"> {{ $message }}
                        </p>
                    @enderror

                </div>

                <input type="submit" value="Publicar"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
            </form>
        </div>
    </div>
@endsection
@push('Scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
@endpush