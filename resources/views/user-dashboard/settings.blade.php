@extends('base')

@section('content')


    <div id="vueApp" class="row justify-content-center">
        <div class="col-12 text-center">
            <h1>Accountinstellingen</h1>
        </div>
        <div class="col-10 border">
            <h3>Persoonlijk</h3>
            <template v-for="(u,key,index) in user">
                <span>@{{ key }}: </span> <span v-show="!u.show" @click="edit(u)">@{{u.value}}</span>
                <input :type="u.type" v-show="u.show" @blur="exit" v-model="u.value"><br>
            </template>
        </div>
        <div class="col-10 border">
            <h3>klassementen</h3>
            <template v-for="(u,key,index) in ranking">
                <span>@{{ key }}: </span> <span v-show="!u.show" @click="edit(u)">@{{u.value}}</span>
                {{--<input :type="u.type" v-show="u.show" @blur="exit" v-model="u.value"><br>--}}

                <select v-show="u.show" v-model="u.value" @blur="exit" name="" id="">
                    <option :selected="u.value == option.rank" v-for="option in u.options" :value="option.rank">@{{
                        option.rank }}
                    </option>
                </select><br>

            </template>
        </div>
        <div class="col-10 border">
            <h3>Account</h3>
            <span>login Email: {{$user->email}} </span><br>
            <span>wachtwoord: ******** </span><br><br>
            <button class="btn btn-danger">verwijder account</button>
        </div>
        <div class="col-10 border">
            test
        </div>
        <div class="col-10 border">
            test
        </div>
    </div>


@endsection

@section('script')
    <script>

        const vue = new Vue({
                el: '#vueApp',
                data: {
                    originalUserData: {},
                    newUserData: {},
                    dataIsChanged: null,
                    user: {
                        Naam: {
                            value: '{{$user->name}}',
                            show: false,
                            type: 'text'
                        },
                        Geboortedatum: {
                            value: '{{$user->birthday}}',
                            show: false,
                            type: 'date'
                        },
                        Geslacht: {
                            value: '{{$user->gender}}',
                            show: false,
                            type: 'text'
                        },
                        postcode: {
                            value: '{{$user->location->postcode}}',
                            show: false,
                            type: 'number'
                        }
                    },
                    ranking: {
                        Enkel: {
                            value: '{{$ranking[0]->singleRank->rank}}',
                            show: false,
                            type: 'text',
                            options: {}
                        },
                        Dubbel: {
                            value: '{{$ranking[0]->dubbleRank->rank}}',
                            show: false,
                            type: 'text',
                            options: {}

                        },
                        Mix: {
                            value: '{{$ranking[0]->mixRank->rank}}',
                            show: false,
                            type: 'text',
                            options: {}
                        },
                    }
                },
                methods: {
                    exit: function () {
                        console.log('e');

                        for (var key in this.user) {
                            this.user[key].show = false;
                            if (this.user[key].value == '')
                                this.user[key].value = 'vul een geldige waarde in';
                        }
                        for (var key in this.ranking) {
                            this.ranking[key].show = false;
                            if (this.ranking[key].value == '')
                                this.ranking[key].value = 'vul een geldige waarde in';
                        }
                    },
                    edit: function (ev) {
                        console.log(ev);
                        this.exit();
                        ev.show = true;
                    },
                    isChanged: function () {
                        this.dataIsChanged = JSON.stringify(this.originalUserData) !== JSON.stringify(this.newUserData)
                    }
                },
                watch: {
                    'user':
                        {
                            handler: function (val, oldVal) {
                                for (var key in this.user) {
                                    this.newUserData[key] = this.user[key].value;
                                }
                                for (var key in this.ranking) {
                                    this.newUserData[key] = this.ranking[key].value;
                                }
                                this.isChanged();
                            }
                            ,
                            deep: true
                        }
                    ,
                    'ranking':
                        {
                            handler: function (val, oldVal) {
                                for (var key in this.user) {
                                    this.newUserData[key] = this.user[key].value;
                                }
                                for (var key in this.ranking) {
                                    this.newUserData[key] = this.ranking[key].value;
                                }
                                this.isChanged();
                            }
                            ,
                            deep: true
                        }
                }
                ,
                mounted: function () {
                    for (var key in this.user) {
                        this.originalUserData[key] = this.user[key].value;
                    }
                    for (var key in this.ranking) {
                        this.originalUserData[key] = this.ranking[key].value;
                    }

                    for (var key in this.ranking) {
                        this.ranking[key].options = JSON.parse(@json($rankingOptions));
                    }


                }
            })
        ;
    </script>

@endsection