// Define a Vue component
Vue.component('book-view', {
    // -------------------------------------
    template: `
    <div class="form_container" >
    
         <div class="heading_container">
             <h2>Книга отзывов</h2>
         </div>

        <div class="card" style="max-height: 500px; overflow-y: auto;">
            <div v-for="comment in reversedComments" class="card-body" data-mdb-perfect-scrollbar="true" style="position: relative;">
            
                
                <div class="d-flex justify-content-between">
                    <p class="small mb-1">{{comment.firstname}} {{comment.lastname}}</p>
                    <p class="small mb-1 text-muted">{{formatDate(comment.time_at)}}</p>
                </div>
                <div class="d-flex flex-row justify-content-start">
                    <img src="/public/avatars/default_profile_pic.jpg"
                         alt="avatar 1" style="width: 45px; height: 100%;">
                    <div>
                        <p class="small p-2 ms-3 mb-3 rounded-3" style="background-color: #f5f6f7;">{{comment.comment}}</p>
                    </div>
                </div>
            </div>

        </div> 
    </div>
      `,
    // -------------------------------------
    data() {
        return {
            comments: [],
            newComment: [],
            webSocket: {
                host: "localhost",
                port: "2346",
                ws: "",
            },

        };
    },
    // -------------------------------------
    mounted() {
        // Этот код будет выполнен после монтирования компонента
        //отправляем запрос на api для получение данных
        console.log('Компонент был успешно монтирован.');
        axios.get(
            '/api/feedbacks',
        ).then(response => {
            this.comments = response.data.data;
            console.log(this.comments);
        });

        //подключаемся к вебсокет серверу
        this.webSocket.ws = new WebSocket(`ws://${this.webSocket.host}:${this.webSocket.port}`);

        this.webSocket.ws.onopen = () => {
            console.log('Соединение установлено и готово для обмена данными');
        };

        this.webSocket.ws.onerror = (error) => {
            console.error('Произошла ошибка при установке соединения: ', error);
        };

        this.webSocket.ws.onmessage = response => {
            this.comments.push(JSON.parse(response.data));
            console.log(response.data);
        }

    },
    // -------------------------------------
    methods: {
        formatDate(date) {
            const months = [
                "январь", "февраль", "март", "апрель", "май", "июнь",
                "июль", "август", "сентябрь", "октябрь", "ноябрь", "декабрь"
            ];
            const d = new Date(date);
            const month = months[d.getMonth()];
            const day = d.getDate();
            const year = d.getFullYear();

            return `${day} ${month} ${year}`;
        },

    },
    // -------------------------------------
    computed: {
        reversedComments() {
            // Используйте метод reverse() для изменения порядка элементов массива
            return this.comments.slice().reverse();
        },
    },
});


// Define a Vue component
Vue.component('book-store', {
    template: `
                <div class="form_container">
                
                    <div class="heading_container">
                        <h2>Оставьте отзыв</h2>
                    </div>
                
                

                        <div>
                             <label for="firstname">Имя:</label>
                            <input 
                                type="text"
                                id="firstname"
                                v-model="formData.firstname"
                                class="form-control"
                                placeholder="Введите имя"
                            />
                        </div>
                        <div>
                            <label for="firstname">Фамилия:</label>
                            <input 
                                type="text" 
                                id="lastname" 
                                v-model="formData.lastname" 
                                class="form-control" 
                                placeholder="Введите фамилию" 
                            />
                        </div>    
                        
                         <div>
                             <label for="phone">Номер телефона:</label>
                            <input 
                                type="text" 
                                id="phone" 
                                v-model="formData.phone" 
                                class="form-control" 
                                placeholder="Введите номер телефона" 
                            />
                        </div>   
                                             
                         <div>
                             <label for="comment">Комментарий:</label>
                            <input 
                                type="text" 
                                id="comment" 
                                v-model="formData.comment" 
                                class="form-control" 
                                placeholder="Напишите комментарий" 
                            />
                        </div>
                         
                        <div class="btn_box">
                            <button @click="sendFormData" 
                                    :disabled="isButtonDisabled" 
                                    :style="{ 'background-color': isButtonDisabled ? 'gray' : '' }"
                            >
                                Отправить
                            </button>
                        </div>

                       
                
                </div>
  `,
    data() {
        return {
            formData: {
                firstname: "",
                lastname: "",
                phone: "",
                comment: "",
            },
            webSocket: {
                ws: "",
                host: "localhost",
                port: "2346",
            },

        };
    },

    beforeCreate() {
        console.log("beforeCreate: Компонент еще не создан");
    },
    created() {
        console.log("created: Компонент создан, начальные данные установлены");
        //Открываем websocket соединение
        this.webSocket.ws = new WebSocket(`ws://${this.webSocket.host}:${this.webSocket.port}`);

        // Устанавливаем обработчик события onopen для отправки данных только после установки соединения
        this.webSocket.ws.onopen = () => {
            console.log('Соединение установлено и готово для обмена данными');
        };

        // Устанавливаем обработчик события onerror для обработки ошибок
        this.webSocket.ws.onerror = (error) => {
            console.error('Произошла ошибка при установке соединения: ', error);
        };
    },
    beforeMount() {
        console.log("beforeMount: Компонент готовится к монтированию в DOM");
    },
    mounted() {
        console.log("mounted: Компонент добавлен в DOM");
    },
    beforeUpdate() {
        console.log("beforeUpdate: Компонент готовится к обновлению");
    },
    updated() {
        console.log("updated: Компонент обновлен");
    },
    beforeDestroy() {
        console.log("beforeDestroy: Компонент готовится к уничтожению");
    },
    destroyed() {
        console.log("destroyed: Компонент уничтожен");
        if (this.webSocket.ws) {
            this.webSocket.ws.close();
        }
    },

    methods: {
        sendFormData() {

            axios.post(
                '/api/feedbacks',
                this.formData,
                {
                    headers: {
                        'Content-Type': 'application/json', // Пример другого заголовка
                        'Accept': 'application/json' // Пример другого заголовка
                    }
                }
            ).then(response => {
                console.log(response.data);
                const jsonData = JSON.stringify(this.formData);
                this.formData.firstname = "";
                this.formData.lastname = "";
                this.formData.phone = "";
                this.formData.comment = "";
                this.$forceUpdate();
                this.webSocket.ws.send(jsonData);
            }).catch(error => {
                console.error('Произошла ошибка при выполнении запроса: ', error);
            });
            //console.log(jsonData);
        },
    },

    computed: {
        isButtonDisabled() {
            return (
                this.formData.firstName !== "" &&
                this.formData.lastName !== "" &&
                this.formData.phone !== "" &&
                this.formData.comment !== ""
            );
        },
    },

    watch: {
        "formData.firstName": function (newMessage, oldMessage) {

        },
    }
});


/**
 *
 *
 * тут будут компоненты
 *
 */


// Create a new Vue app and mount it on an element in your HTML
new Vue({
    el: '#app-book'
});

// Define a Vue component
Vue.component('product-view', {
    // -------------------------------------
    template: `
<div>
        <ul class="filters_menu">
          <li :class="{ 'active': data_filter === '#' }" @click="setActiveFilter(false)">Все</li>
          <li 
            v-for="category in categories" 
            :class="{ 'active': data_filter ===category.id }" 
            @click="setActiveFilter(category.id)"
          >{{category.name}}</li>
        </ul>

        <div class="filters-content">
            <div class="row grid">
                    <div v-for="dish in dishes" class="col-sm-6 col-lg-4 all">
                        <div class="box">
                            <div>
                                <div class="img-box">
                                    <img :src="dish.dish_url" alt="">
                                </div>
                                <div class="detail-box">
                                    <h5>
                                       {{dish.dish_name}}
                                    </h5>
                                    <p>
                                        <span 
                                            v-for="ingredient in dish.ingredients" 
                                            v-if="ingredient.ingredient_name!=null"
                                        >
                                            {{ingredient.ingredient_name}}, 
                                        </span>
                                    </p>
                                    <div class="options">
                                        <h6>
                                            {{dish.dish_cost}} руб.
                                        </h6>
                                        <a @click="addToCart(dish)">
                                            <svg
                                                    version="1.1"
                                                    id="Capa_1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                    x="0px"
                                                    y="0px"
                                                    viewBox="0 0 456.029 456.029"
                                                    style="enable-background:new 0 0 456.029 456.029;"
                                                    xml:space="preserve"
                                            >
                                                <g>
                                                     <path
                                                           d="M345.6,
                                                           338.862c-29.184,
                                                           0-53.248,
                                                           23.552-53.248,
                                                           53.248c0,
                                                           29.184,
                                                           23.552,
                                                           53.248,
                                                           53.248,
                                                           53.248c29.184,
                                                           0,
                                                           53.248-23.552,
                                                           53.248-53.248C398.336,
                                                           362.926,
                                                           374.784,
                                                           338.862,
                                                           345.6,
                                                           338.862z"
                                                     />
                                                </g>
                                                <g>
                                                     <path
                                                            d="M439.296,
                                                            84.91c-1.024,
                                                            0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,
                                                            27.566,
                                                            84.992,
                                                            10.67,
                                                            61.952,
                                                            10.67H20.48C9.216,
                                                            10.67,
                                                            0,
                                                            19.886,
                                                            0,
                                                            31.15c0,
                                                            11.264,
                                                            9.216,
                                                            20.48,
                                                            20.48,
                                                            20.48h41.472c2.56,
                                                            0,
                                                            4.608,
                                                            2.048,
                                                            5.12,
                                                            4.608l31.744,
                                                            216.064c4.096,
                                                            27.136,
                                                            27.648,
                                                            47.616,
                                                            55.296,
                                                            47.616h212.992c26.624,
                                                            0,49.664-18.944,
                                                            55.296-45.056l33.28-166.4C457.728,
                                                            97.71,
                                                            450.56,
                                                            86.958,
                                                            439.296,
                                                            84.91z"
                                                     />
                                                </g>
                                                <g>
                                                     <path
                                                           d="M215.04,
                                                           389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,
                                                           1.536-52.224,
                                                           26.112-51.2,
                                                           55.296c1.024,
                                                           28.16,24.064,
                                                           50.688,52.224,
                                                           50.688h1.024C193.536,
                                                           443.31,
                                                           216.576,
                                                           418.734,
                                                           215.04,
                                                           389.55z"
                                                     />
                                                </g>

                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
</div>     
      `,
    // -------------------------------------
    data() {
        return {
            dishes: [],
            categories: [],
            data_filter: '#',
        };
    },
    // -------------------------------------
    mounted() {
        // Этот код будет выполнен после монтирования компонента
        //отправляем запрос на api для получение данных
        console.log('Компонент был успешно монтирован!.');
        axios.get(
            '/api/products',
        ).then(response => {
            console.log(response.data
            );
            this.dishes = response.data.data.dishes;
            this.categories = response.data.data.categories;
        }).catch(error => {
            console.error('Error fetching data:', error);
        });

    },
    // -------------------------------------
    methods: {
        setActiveFilter(categoryId) {

            // console.log(categoryId);

            let url = null;

            if (categoryId) {
                this.data_filter = categoryId;
                url = `/api/products/categories?categoryId=${categoryId}`;
            } else {
                this.data_filter = "#";
                url = `/api/products/categories`;
            }

            axios.get(
                url,
            ).then(response => {
                this.dishes = response.data.data.dishes;
            });
        },

        addToCart(dish) {
            let cartItems = JSON.parse(localStorage.getItem('cartItems')) || {data: []};
            if (!cartItems.data.some(item => item.dish_id === dish.dish_id)) {
                let dishWithQuantity = {...dish, dish_quantity: 1};
                cartItems.data.push(dishWithQuantity);
                localStorage.setItem('cartItems', JSON.stringify(cartItems));
            }

        },
    },
    // -------------------------------------
    computed: {},
});

new Vue({
    el: '#app-product'
});


Vue.component('search-view', {
    template: `
<div>
    <div class="container mt-5 d-flex">
            <input class="form-control me-2" type="search" v-model="searchTerm" placeholder="Поиск блюд..." aria-label="Поиск">
            <button class="btn btn-outline-primary" @click="setActiveFilter(searchTerm)">Поиск</button>
    </div>
    
    <div class="filters-content" v-if="dishes!=null">
            <div class="row grid">
                    <div  v-for="dish in dishes" class="col-sm-6 col-lg-4 all">
                        <div class="box">
                            <div>
                                <div class="img-box">
                                    <img :src="dish.dish_url" alt="">
                                </div>
                                <div class="detail-box">
                                    <h5>
                                       {{dish.dish_name}}
                                    </h5>
                                    <p>
                                        <span 
                                            v-for="ingredient in dish.ingredients" 
                                            v-if="ingredient.ingredient_name!=null"
                                        >
                                            {{ingredient.ingredient_name}}, 
                                        </span>
                                    </p>
                                    <div class="options">
                                        <h6>
                                            {{dish.dish_cost}} руб.
                                        </h6>
                                        <a @click="addToCart(dish)">
                                            <svg
                                                    version="1.1"
                                                    id="Capa_1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                    x="0px"
                                                    y="0px"
                                                    viewBox="0 0 456.029 456.029"
                                                    style="enable-background:new 0 0 456.029 456.029;"
                                                    xml:space="preserve"
                                            >
                                                <g>
                                                     <path
                                                           d="M345.6,
                                                           338.862c-29.184,
                                                           0-53.248,
                                                           23.552-53.248,
                                                           53.248c0,
                                                           29.184,
                                                           23.552,
                                                           53.248,
                                                           53.248,
                                                           53.248c29.184,
                                                           0,
                                                           53.248-23.552,
                                                           53.248-53.248C398.336,
                                                           362.926,
                                                           374.784,
                                                           338.862,
                                                           345.6,
                                                           338.862z"
                                                     />
                                                </g>
                                                <g>
                                                     <path
                                                            d="M439.296,
                                                            84.91c-1.024,
                                                            0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,
                                                            27.566,
                                                            84.992,
                                                            10.67,
                                                            61.952,
                                                            10.67H20.48C9.216,
                                                            10.67,
                                                            0,
                                                            19.886,
                                                            0,
                                                            31.15c0,
                                                            11.264,
                                                            9.216,
                                                            20.48,
                                                            20.48,
                                                            20.48h41.472c2.56,
                                                            0,
                                                            4.608,
                                                            2.048,
                                                            5.12,
                                                            4.608l31.744,
                                                            216.064c4.096,
                                                            27.136,
                                                            27.648,
                                                            47.616,
                                                            55.296,
                                                            47.616h212.992c26.624,
                                                            0,49.664-18.944,
                                                            55.296-45.056l33.28-166.4C457.728,
                                                            97.71,
                                                            450.56,
                                                            86.958,
                                                            439.296,
                                                            84.91z"
                                                     />
                                                </g>
                                                <g>
                                                     <path
                                                           d="M215.04,
                                                           389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,
                                                           1.536-52.224,
                                                           26.112-51.2,
                                                           55.296c1.024,
                                                           28.16,24.064,
                                                           50.688,52.224,
                                                           50.688h1.024C193.536,
                                                           443.31,
                                                           216.576,
                                                           418.734,
                                                           215.04,
                                                           389.55z"
                                                     />
                                                </g>

                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
    </div>
</div>
  `,
    data() {
        return {
            dishes: [], // Здесь хранятся все блюда
            searchTerm: '', // Здесь хранится текущий поисковый запрос
        };
    },

    // -------------------------------------
    computed: {},
    methods: {
        setActiveFilter(searchTerm) {

            //console.log(searchTerm);

            let url = `/api/search?q=${searchTerm}`;

            axios.get(
                url,
            ).then(response => {
                this.dishes = response.data.data.dishes;
                //console.log(this.dishes);
            });
        },

        addToCart(dish) {
            let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
            if (!cartItems.some(item => item.dish_id === dish.dish_id)) {
                cartItems.push(dish);
                localStorage.setItem('cartItems', JSON.stringify(cartItems));
            }

        },
    },
});

new Vue({
    el: '#app-search',
});

Vue.component('cart-view', {
    template: `
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="d-flex justify-content-between align-items-center mb-5">
                                        <h1 class="fw-bold mb-0 text-black">Корзина для покупок</h1>
                                        <h6 class="mb-0 text-muted">{{cartData.cartDishes.length}} блюд</h6>
                                    </div>

                                    <hr class="my-4">

                                    <div 
                                        class="row mb-4 d-flex justify-content-between align-items-center" 
                                        v-if="cartData.cartDishes!=null" 
                                        v-for="(cartDish, index) in cartData.cartDishes"
                                    >
                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img
                                                 :src="cartDish.dish_url"
                                                 class="img-fluid rounded-3" 
                                                 :alt="cartDish.dish_name"
                                            >
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <h6 class="text-black mb-0">{{cartDish.dish_name}}</h6>
                                        </div>

                                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                            <button class="btn btn-link px-2" @click="decrementValue(index)">
                                                <i class="fas fa-minus"></i>
                                            </button>



                                            <input
                                                    id="form1-product1"
                                                    min="0"
                                                    name="quantity"
                                                    v-model="cartDish.dish_quantity"
                                                    type="number"
                                                    class="form-control form-control-sm"
                                                    style="width: 40px;"
                                            />

                                            <button class="btn btn-link px-2"
                                                    @click="incrementValue(index)">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>

                                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                            <h6 class="mb-0">
                                                {{cartDish.dish_cost*cartDish.dish_quantity}} руб.
                                            </h6>
                                        </div>
                                        
                                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                            <a class="text-muted" @click="dishRemove(cartDish)">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </div>
                                        
                                    </div>

                                    <hr class="my-4">

                                    <div class="pt-5">
                                        <h6 class="mb-0">
                                            <a href="/products" class="text-body">
                                                <i class="fas fa-long-arrow-alt-left me-2"></i>
                                                Вернуться к покупкам
                                            </a>
                                        </h6>
                                    </div>

                                </div>
                            </div>
                            
                            <div class="col-lg-4 bg-grey">
                                <div class="p-5">
                                    <h3 class="fw-bold mb-5 mt-2 pt-1">Сумма</h3>
                                    <hr class="my-4">

                                    <div class="d-flex justify-content-between mb-4">
                                        <h5 class="text-uppercase">блюд: {{cartData.cartDishes.length}}</h5>
                                        <h5>{{dishesPrices}} руб.</h5>
                                    </div>

                                    <h5 class="text-uppercase mb-3">Промокод</h5>

                                    <div class="mb-5">
                                        <div class="form-outline">
                                            <input 
                                                    type="text" 
                                                    id="promocode" 
                                                    class="form-control form-control-lg"
                                                    placeholder="Введите промокод"
                                                    v-model="promocodeValue"
                                                    @keyup.enter="sendPromocode()"
                                            />
                                            <label 
                                                for="promocode" 
                                                class="form-check-label" 
                                                v-if="!this.cartData.promocodes.length"
                                            >
                                                Нажмите Enter после ввода промокода
                                            </label>
                                            
                                            <label 
                                                for="promocode" 
                                                class="form-check-label" 
                                                v-else 
                                                
                                            >
                                                <p
                                                    class="text-uppercase"
                                                    v-for="promocode in cartData.promocodes"
                                                >
                                                    Промокод: {{promocode.value}} 
                                                </p>
                                                
                                            </label>
                                            
                                            <p
                                               v-if="errorMessage!=null"
                                               class="text-uppercase"
                                               style="color: red"
                                            >
                                               {{this.errorMessage}}
                                            </p>
                                         
                                        </div>
                                    </div>

                                    <hr class="my-4">

                                    <div class="d-flex justify-content-between mb-5" style="white-space: nowrap;" >
                                        <h5 class="text-uppercase" style="padding-right: 20px; ">Общая сумма:</h5>
                                        <h5>{{totalPrice.toFixed(2)}} руб.</h5>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <h5 class="text-uppercase">Способ оплаты:</h5>
                                        <div class="form-check">
                                            <input
                                                type="radio"
                                                id="payment-cash"
                                                class="form-check-input"
                                                v-model="cartData.paymentMethod"
                                                value="наличными"
                                            >
                                            <label 
                                                for="payment-cash" 
                                                class="form-check-label"
                                            >Наличными при получении</label>
                                            
                                        </div>
                                        <div class="form-check">
                                            <input
                                                type="radio"
                                                id="payment-card"
                                                class="form-check-input"
                                                v-model="cartData.paymentMethod"
                                                value="картой"
                                            >
                                            <label 
                                                for="payment-card" 
                                                class="form-check-label"
                                            >Картой при получении</label>
                                        </div>
                                    </div>
                                   
                                   <form action="/orders" method="POST" enctype="multipart/form-data">
                                       <input 
                                            type="hidden" 
                                            name="cartData" 
                                            :value="JSON.stringify(this.cartData)"
                                       >
                                        
                                       <input 
                                           type="submit" 
                                           class="btn btn-dark btn-block btn-lg"
                                           data-mdb-ripple-color="dark"
                                           value="Сформировать заказ"
                                           @click
                                       >
                                        
                                   </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  `,
    data() {
        return {

            cartData: {
                cartDishes: [],
                promocodes: [],
                paymentMethod: "наличными",
            },

            promocodeValue: "",
            errorMessage: "",
            lastPrice: 0,

        };
    },

    // -------------------------------------
    computed: {
        dishesPrices() {
            return this.cartData.cartDishes.reduce((dishesPrices, cartDish) => {
                    return dishesPrices + cartDish.dish_quantity * cartDish.dish_cost;
                },
                0
            );
        },

        totalPrice() {
            if(this.cartData.promocodes.length){
                return this.cartData.promocodes.reduce((totalPrice,promocode)=>{
                        return totalPrice-totalPrice*promocode.discount/100
                },
                    this.dishesPrices
                );
            }

            return this.dishesPrices;
        },

    },
    // -------------------------------------
    methods: {
        decrementValue(index) {
            if (this.cartData.cartDishes[index].dish_quantity > 0) {
                this.cartData.cartDishes[index].dish_quantity--;
                this.setChangeInLocalStorage();
            }
        },

        incrementValue(index) {
            this.cartData.cartDishes[index].dish_quantity++;
            this.setChangeInLocalStorage();
        },

        dishRemove(dish) {
            this.cartData.cartDishes = this.cartData.cartDishes.filter(item => item !== dish);
            this.setChangeInLocalStorage();
        },

        setChangeInLocalStorage() {
            var newCartDishes = {data: this.cartData.cartDishes};
            localStorage.setItem('cartItems', JSON.stringify(newCartDishes));
        },

        sendPromocode() {
            
            if(this.errorMessage!=null)this.errorMessage="";

            var modifyPromocodeValue = {data: {promocodeValue: this.promocodeValue}};

            if(this.cartData.promocodes.length && this.cartData.promocodes.some(item => item.value === this.promocodeValue)){
                this.errorMessage="Промокод можно использовать один раз";
                this.promocodeValue="";
            } else {
                axios.post(
                    '/api/promocodes',
                    JSON.stringify(modifyPromocodeValue),
                    {
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    }
                ).then(response => {
                    console.log();
                    this.cartData.promocodes.push(response.data.data);
                    let promacodesStore={data: this.cartData.promocodes}
                    localStorage.setItem('promocodes',JSON.stringify(promacodesStore));
                    this.promocodeValue="";
                    //console.log(this.cartData.promocodes);

                });
            }


        },
    },

    // -------------------------------------

    mounted() {
        let cartItems=JSON.parse(localStorage.getItem('cartItems'))||[];
        let promocodes=JSON.parse(localStorage.getItem('promocodes'))||[];


        if(cartItems.data && cartItems.data.length){
            this.cartData.cartDishes = cartItems.data
        }

        if(promocodes.data && promocodes.data.length){
            this.cartData.promocodes=promocodes.data;
        }
    },
});

new Vue({
    el: '#app-shopping-cart',
});
