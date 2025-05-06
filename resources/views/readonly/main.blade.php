
            <!-- Main -->
                <div id="main">

                    <!-- One -->
                        <section id="objetivos">
                            <div class="image main" data-position="center">
                                <img src="{{ asset('storage/ediciones/edicion' . \App\Models\Edicion::getEdicionActual()->id . '/banner.png') }}" alt="" />
                            </div>
                            <div class="container">
                                <h3>Objetivos</h3>
                                <p>Las Olimpiada Informáticas de la Región de Murcia para los Institutos de Educación Secundaria y
                                    Centros Integrados de Formación Profesional tiene como objetivos:</p>
                                <ul>
                                    <li>El fomento del trabajo en equipo, propiciando que los alumnos focalicen sus esfuerzos en conseguir
                                        metas comunes, potenciando la sinergia que les lleve a obtener soluciones más rápidas y eficientes
                                        que de forma individual.</li>
                                    <li>El impulso de los estudios de Formación Profesional, particularmente de Informática, los cuales
                                        tienen como finalidad la preparación de los alumnos para la actividad en este campo profesional. La
                                        Formación Profesional proporciona a sus alumnos un aprendizaje polivalente, que les permite
                                        adaptarse a las modificaciones laborales que pueden producirse a lo largo de su vida.</li>
                                </ul>
                            </div>
                        </section>

                    <!-- Two -->
                        <section id="categorias">
                            <x-frontend.categorias />
                        </section>

                    <!-- Three -->
                        <section id="inscripciones">
                            <div class="container">
                                <h3>Inscripciones</h3>
                                @can('store-inscripcion')
                                    @include('partials.inscripciones.inscripcion_form')
                                @else()
                                    <p>Las inscripciones están cerradas.</p>
                                    @if (session('edicion'))
                                        <p>Se abrirán entre el {{ session('edicion')->fecha_apertura }} y el {{ session('edicion')->fecha_cierre }}.</p>
                                    @endif
                                @endcan
                            </div>
                        </section>

                    <!-- Horario -->
                    <section id="horario">
                        <div class="container">
                            <h3>Horario</h3>
                            <img src="{{ asset('images/agendaOlimpica.jpeg') }}"
                            alt="Agenda Olímpica" class="agenda-olimpica">
                        </div>
                    </section>

                    <!-- Four -->
                        <section id="resultados">
                            <x-frontend.resultados />
                        </section>

                        <!-- Five -->
                            <section id="patrocinadores">
                                <x-frontend.patrocinadores />
                            </section>

                        <!-- Six -->
                            <section id="ejercicios_ediciones_anteriores">
                                    @include('partials.frontend.ejercicios_ediciones_anteriores')
                            </section>
                </div>
