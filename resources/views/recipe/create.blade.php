<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div id="app" class="p-4">
    <h1 class="mb-4">レシピ投稿機能のサンプル</h1>
    <div class="row">
        <div class="col-4">
            <div class="mb-4">
                <label>料理名</label>
                <input type="text" class="form-control" v-model="params.name">
            </div>
            <div class="mb-3">
                <div class="float-end">
                    <button type="button" class="btn btn-outline-primary btn-sm" @click="addIngredient">＋</button>
                </div>
                <label>食材<small>（<span v-text="params.ingredients.length"></span>件）</small></label>
            </div>
            <div class="mb-4">
                <div class="position-relative mb-3" v-for="(ingredient,index) in params.ingredients">
                    <input type="text" class="form-control" v-model="params.ingredients[index]">
                    <div class="position-absolute" style="right:10px;top:8px;">
                        <small>
                            <a href="#" type="button" @click="removeIngredient(index)">削除</a>
                        </small>
                    </div>
                </div>
            </div>
            <div class="text-end pt-2">
                <button type="button" class="btn btn-primary btn-lg" @click="onSubmit">保存する</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/vue@3.1.1/dist/vue.global.prod.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>

    Vue.createApp({
        data() {
            return {
                params: {
                    name: '',
                    ingredients: []
                }
            }
        },
        methods: {
            addIngredient() {

                this.params.ingredients.push('');

            },
            removeIngredient(removingIndex) {

                this.params.ingredients.splice(removingIndex, 1);

            },
            onSubmit() {

                if(confirm('保存します。よろしいですか？')) {

                    const url = '{{ route('recipe.store') }}';

                    axios.post(url, this.params)
                        .then(response => {

                            if(response.data.result === true) {

                                alert('保存が完了しました。');

                            }

                        })
                        .catch(error => {

                            // TODO: ここでエラー処理をする
                            console.log(error.response.data);
                            alert('入力エラーがありました');

                        });

                }

            }
        }
    }).mount('#app');

</script>
</body>
</html>