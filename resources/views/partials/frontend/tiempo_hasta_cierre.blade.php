
                                    <span>
                                        @php
                                            $fecha_cierre = \Carbon\Carbon::parse(session('edicion')->fecha_cierre);

                                        @endphp
                                        Las inscripciones se cierran dentro de
                                        {{ $fecha_cierre->diffInDays() }} días
                                        {{ $fecha_cierre->diffInHours() % 24 }} horas
                                        {{ $fecha_cierre->diffInMinutes() % 60 }} minutos
                                        {{ $fecha_cierre->diffInSeconds() % 60 }} segundos
                                    </span>
