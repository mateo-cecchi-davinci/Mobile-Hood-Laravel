@extends('layouts.partnerLayout')

@section('content')
    <div class="banner">
        <div class="banner-opacity">
            <section class="container">
                <div class="row justify-content-center align-items-center p-5 pt-0 banner-height">
                    <div class="col-lg-6 text-light">
                        <h1 class="mb-4">Empieza a vender en la app <span class="fw-bold">líder en pedidos online de
                                Latinoamérica</span></h1>
                        <ul class="banner-list">
                            <li><i class="bx bx-right-arrow-alt"></i> El mejor canal de ventas para tu local</li>
                            <li><i class="bx bx-right-arrow-alt"></i> En el bolsillo de millones de usuarios</li>
                            <li><i class="bx bx-right-arrow-alt"></i> El sistema de entrega más avanzado</li>
                            <li><i class="bx bx-right-arrow-alt"></i> Todo tu menú online y autogestionable</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <div class="card rounded-4 shadow-lg banner-card">
                            <h3 class="mb-4 fw-semibold">¡Registrá tu local ahora mismo!</h3>
                            <p class="p-3 fs-5"><span class="fw-bold">10% de comisión</span>
                                durante los primeros 30 días
                            </p>
                            <form action="" method="POST" enctype="multipart/form-data" class="pb-3">
                                @csrf
                                <input type="text" name="name" class="form-control mb-3 py-3"
                                    placeholder="{{ __('messages.name') }} *">
                                <input type="text" name="lastname" class="form-control mb-3 py-3"
                                    placeholder="{{ __('messages.lastname') }} *">
                                <select name="buisness_category[]" class="form-select mb-3 py-3">
                                    <option value="" selected>{{ __('messages.select_category') }}</option>
                                    <option value="butcher_shop">{{ __('messages.butcher_shop') }}</option>
                                    <option value="grocery_store">{{ __('messages.grocery_store') }}
                                    </option>
                                    <option value="winery">{{ __('messages.winery') }}</option>
                                </select>
                                <div class="d-flex mb-3">
                                    <input type="number" name="phone" class="form-control me-3 py-3"
                                        placeholder="{{ __('messages.phone') }} *">
                                    <input type="text" name="email" class="form-control py-3"
                                        placeholder="{{ __('messages.email') }} *">
                                </div>
                                <input type="submit" class="text-light w-100 border-0 rounded-2 py-3 red-bg"
                                    value="Comenzar">
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <section class="container py-5">
        <h1 class="text-center steps-title">
            Comenzar a </br>
            <span class="fw-bold strong">vender</span> </br>
            es así de simple
        </h1>

        <div class="row juistify-content-center align-items-center py-5 text-center">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <img src="/img/partner/steps/1.png" alt="First step image">
                <p class="fw-semibold">Registrá tus datos y la información bancaria de tu local.</p>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <img src="/img/partner/steps/2.png" alt="Second step image">
                <p class="fw-semibold">Cargá tu menú, horarios y logo en nuestro portal de autogestión.</p>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <img src="/img/partner/steps/3.png" alt="Third step image">
                <p class="fw-semibold">Probá tu sistema de recepción de pedidos.</p>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <img src="/img/partner/steps/4.png" alt="Fourth step image">
                <p class="fw-semibold">¡Y listo! ¡Recibí tus primeros pedidos en nuestra plataforma!</p>
            </div>
        </div>

        <p class="text-center steps-text">
            Además, te compartiremos distintos entrenamientos para que todo quede claro durante el proceso y puedas
            potenciar tus ventas desde el primer día.
        </p>
    </section>

    <section>
        <div class="py-5 bg-blue">
            <h1 class="text-center text-light">
                Gestionamos </br>
                <span class="fw-bold strong">7 pedidos</br>por segundo</span>
            </h1>
        </div>
        <div class="takeaway_girl-bg">
            <div class="d-flex justify-content-center">
                <div class="takeaway_girl-img">
                    <img src="/img/partner/takeaway_girl.png" alt="nose">
                </div>
            </div>
        </div>
        <div class="py-5 red-bg">
            <div class="d-flex justify-content-center">
                <div class="text-center">
                    <p class="text-light pb-3 takeaway_girl-text">
                        Con la app de pedidos de Mobile Hood, tu local puede ser el local más elegido de tu zona.
                        Súmate a la plataforma más grande y llega a miles de nuevos clientes.
                    </p>
                    <a href="#" class="rounded-0 fw-semibold p-3 orange-bg text-decoration-none text-dark">
                        Quiero vender más
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="container py-5">
        <h1 class="text-center fw-semibold">¿Cómo funcionamos?</h1>
        <div class="row justify-content-center py-5">

            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="d-flex justify-content-center align-items-center info-img">
                        <img src="/img/partner/info/1.png" alt="posnet image">
                    </div>
                    <div class="card-body">
                        <h3 class="my-2 fw-normal">Cómo recibir pedidos</h3>
                        <p class="opacity-75">
                            Con tu sistema de recepción podrás aceptar tus pedidos, verificar el horario de
                            entrega y tendrás toda la información necesaria para entregarlo correctamente.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="d-flex justify-content-center align-items-center info-img">
                        <img src="/img/partner/info/2.png" alt="bag image">
                    </div>
                    <div class="card-body">
                        <h3 class="my-2 fw-normal">Cómo gestionar tu local</h3>
                        <p class="opacity-75">
                            En Partner Portal podrás modificar tu menú y horarios de apertura, descargar tu Estado de Cuenta
                            y mucho más.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="d-flex justify-content-center align-items-center info-img">
                        <img src="/img/partner/info/3.webp" alt="notebook image">
                    </div>
                    <div class="card-body">
                        <h3 class="my-2 fw-normal">Cómo entregar los pedidos</h3>
                        <p class="opacity-75">
                            Cumplir con los tiempos de entrega y las expectativas de los clientes permite asegurarles una
                            gran experiencia. ¡Cuidar tu operativa es clave para que los usuarios vuelvan a confiar y así
                            poder vender cada vez más!
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="d-flex justify-content-center align-items-center info-img">
                        <img src="/img/partner/info/4.webp" alt="second notebook image">
                    </div>
                    <div class="card-body">
                        <h3 class="my-2 fw-normal">Cómo potenciar tus ventas</h3>
                        <p class="opacity-75">
                            Te ofrecemos distintas herramientas para publicitar tu local y aumentar tu visibilidad en
                            nuestra aplicación, ¡logrando así más ventas y nuevos clientes!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="text-center lightblue-bg">
            <h1 class="fw-bold strong">La flota más grande</h1>
            <p class="fs-1 fw-normal mb-4">de Latinoamérica</p>
            <div class="d-flex justify-content-center">
                <p class="fw-normal">
                    Sólo tendrás que ocuparte de preparar el mejor pedido. ¡De cobrarlo nos encargamos nosotros!
                </p>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center pt-3 images-bg pb-4">
            <div class="side-images">
                <img src="/img/partner/man_with_phone.jpg" alt="man holding phone" class="p-0">
            </div>
            <div class="middle-image">
                <img src="/img/partner/takeaway_man.png" alt="takeaway man" class="p-0">
            </div>
            <div class="side-images">
                <img src="/img/partner/girl_with_phone.jpg" alt="girl holding phone" class="p-0">
            </div>
        </div>
        <div class="pt-4 yellow-bg">
            <div class="d-flex justify-content-center">
                <div class="text-center">
                    <p class="pb-3">
                        Contamos con la tecnología más avanzada para que puedas gestionar tu negocio cargando productos,
                        controlar el inventario y gestionar pagos de manera eficiente y ágil asegurando el éxito de tu
                        negocio.
                    </p>
                    <a href="#" class="text-decoration-none rounded-0 fw-semibold p-3 text-light red-bg">
                        Quiero empezar a vender
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="faqs-container">
            <h2 class="fw-semibold">Preguntas frecuentes</h2>
            <div>
                <div class="faq">
                    <div class="head">
                        <span class="fw-semibold">¿Qué requisitos debo cumplir para sumarme a Mobile Hood y empezar a
                            vender?</span>
                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 14.469L1 6.46897L1.96897 5.5L9 12.531L16.031 5.5L17 6.46897L9 14.469Z"
                                fill="black" />
                        </svg>
                    </div>
                    <div class="content">
                        <p>
                            Documento de identidad, Inicio de actividades de Servicio de impuestos internos y Cuenta
                            bancaria
                        </p>
                    </div>
                </div>
                <div class="faq">
                    <div class="head">
                        <span class="fw-semibold">¿Cómo y cuándo son los pagos?</span>
                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 14.469L1 6.46897L1.96897 5.5L9 12.531L16.031 5.5L17 6.46897L9 14.469Z"
                                fill="black" />
                        </svg>
                    </div>
                    <div class="content">
                        <p>
                            En la sección "Finanzas" de Partner Portal, podrás ver tu estado de cuenta y las fechas de
                            emisión de tu pago. Cada semana, recibirás tu liquidación y emitiremos tu pago por transferencia
                            bancaria.
                        </p>
                    </div>
                </div>
                <div class="faq">
                    <div class="head">
                        <span class="fw-semibold">¿Cómo gestiono la información/datos de mi negocio?</span>
                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 14.469L1 6.46897L1.96897 5.5L9 12.531L16.031 5.5L17 6.46897L9 14.469Z"
                                fill="black" />
                        </svg>
                    </div>
                    <div class="content">
                        <p>
                            En PedidosYa contás con Partner Portal, nuestro sitio de autogestión, donde podrás visualizar
                            datos relevantes de tu negocio y realizar acciones como modificar precios, descripciones,
                            productos y mucho más.
                            Además, contás con un chat de Ayuda en Línea las 24 hs donde nuestros agentes te ayudarán en lo
                            que necesites.
                            Para loguearte en Partner Portal de PedidosYa, recibirás tu usuario y contraseña en el correo
                            electrónico que utilizaste para registrar tu negocio. Las credenciales, una vez que te son
                            enviadas, tienen apenas unas horas de vigencia, por lo que te recomendamos realizar el registro
                            apenas recibas el correo electrónico.
                        </p>
                    </div>
                </div>
                <div class="faq">
                    <div class="head">
                        <span class="fw-semibold">¿Con quién me contacto si tengo algún problema?</span>
                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 14.469L1 6.46897L1.96897 5.5L9 12.531L16.031 5.5L17 6.46897L9 14.469Z"
                                fill="black" />
                        </svg>
                    </div>
                    <div class="content">
                        <p>
                            Para poder ayudarte en cualquier tema vinculado a tu cuenta, dudas, consultas o problemas con
                            alguna orden, podés comunicarte a través de Ayuda en Línea en Partner Portal o en tu sistema de
                            recepción de pedidos (GoDroid o GoWin) las 24 hs todos los días de la semana.
                        </p>
                    </div>
                </div>
                <div class="faq">
                    <div class="head">
                        <span class="fw-semibold">¿Cómo debo operar en el día a día?</span>
                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 14.469L1 6.46897L1.96897 5.5L9 12.531L16.031 5.5L17 6.46897L9 14.469Z"
                                fill="black" />
                        </svg>
                    </div>
                    <div class="content">
                        <p>
                            En PedidosYa cuidamos mucho a nuestros usuarios y queremos ofrecerles una experiencia increíble,
                            rápida y fácil, por eso es muy importante que:
                            1- Aceptes los pedidos de manera rápida para evitar que se cancelen.
                            2- Evites rechazar pedidos porque es muy frustrante para los clientes y a su vez, tu comercio
                            pierde reputación.
                            3- Verifiques en la orden el horario de llegada del repartidor para evitar demoras en la promesa
                            de entrega a nuestros usuarios.
                            Es clave prestar atención a estos puntos para evitar cierres de tu local por fallas operativas.
                            Estos cierres son automáticos y buscan cuidar la reputación de tu local, la experiencia del
                            usuario y la salud de nuestra plataforma.
                            Si tienes inconvenientes o demoras en la cocina, no dudes en contactarte con Ayuda en Línea en
                            Partner Portal para que podamos guiarte sobre cómo resolverlos.
                        </p>
                    </div>
                </div>
                <div class="faq">
                    <div class="head">
                        <span class="fw-semibold">¿Qué debo tener en cuenta a la hora de recibir un pedido?</span>
                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 14.469L1 6.46897L1.96897 5.5L9 12.531L16.031 5.5L17 6.46897L9 14.469Z"
                                fill="black" />
                        </svg>
                    </div>
                    <div class="content">
                        <p>
                            En PedidosYa, cuidamos mucho la experiencia de nuestros usuarios y queremos que vuelvan a pedir.
                            Por eso, cuando recibas un pedido, es muy importante:
                            1- Que prestes atención a tu sistema de recepción y confirmes el pedido antes de los 5 minutos
                            de haber ingresado, para evitar que ese pedido se cancele.
                            2- Que evites rechazar órdenes ya que esto implica una cancelación para los usuarios. Si aceptás
                            órdenes de manera rápida y no las cancelas, podrás asegurar una buena experiencia para tus
                            clientes, ¡que volverán a elegirte!
                        </p>
                    </div>
                </div>
                <div class="faq">
                    <div class="head">
                        <span class="fw-semibold">¿Cómo funcionan las áreas de entrega?</span>
                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 14.469L1 6.46897L1.96897 5.5L9 12.531L16.031 5.5L17 6.46897L9 14.469Z"
                                fill="black" />
                        </svg>
                    </div>
                    <div class="content">
                        <p>
                            En PedidosYa queremos garantizar la mejor experiencia para nuestros usuarios y la calidad de los
                            productos que reciben. Por eso nuestras áreas de entrega se determinan en función de tiempos de
                            manejo. Las áreas de entrega son dinámicas, esto significa que pueden modificarse en días de
                            mucha lluvia o de mucho tráfico. De esta forma, evitamos que los tiempos se vean afectados y
                            aseguramos la calidad de tus productos.
                        </p>
                    </div>
                </div>
                <div class="faq">
                    <div class="head">
                        <span class="fw-semibold">¿Puedo contratar publicidad en la app de PedidosYa?</span>
                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 14.469L1 6.46897L1.96897 5.5L9 12.531L16.031 5.5L17 6.46897L9 14.469Z"
                                fill="black" />
                        </svg>
                    </div>
                    <div class="content">
                        <p>
                            En PedidosYa contamos con varias propuestas para que destaques tu restaurante en la app con
                            espacios de posicionamiento promocionado según tus objetivos de venta. Podés gestionarlos desde
                            Partner Portal en forma directa.
                            También podrás sumarte a campañas de Marketing con productos seleccionados y aplicar descuentos
                            en productos específicos o en todo tu menú. Esto te da mayor visibilidad, atrae mucho a los
                            usuarios y ayuda a potenciar tu negocio.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="/js/partner/home/faqs.js"></script>
@endsection
