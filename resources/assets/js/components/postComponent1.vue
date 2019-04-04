<template>
  <div class="post">
    <h3>Name : {{name}}</h3>
    <p>Created At : {{ created_at }} </p>
    <p>{{ body }}</p>
    <img :src="'/img/' + image" alt="" class="img-responsive" width="80px" height="80px;">
    <a :href="'/posts/' + id " class="btn btn-primary">Read More</a>
    <a href="" @click.prevent="likeIt">
      <small> {{ likeCount }} </small>
      <i class="fa fa-thumbs-up"></i>
    </a>
    <div class="row">
      <div class="col-sm-6">

        <a :href="'/posts/' + id + '/edit/'" class="btn btn-primary">Edit</a>

      </div>
      <div class="col-sm-6">
        <a href="" @click.prevent="deleteIt(id)">
          <small>Delete</small>
          <i class="fa fa-trash-o"></i>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        data(){
          return {
            likeCount:0,
            blog:[]
          }
        },

        props:[
          'body','id','created_at','name','image','post_id','login','likes'
        ],

        created(){
          this.likeCount= this.likes;
        },

        methods:{
          likeIt(){

            if (this.login) {
              axios.post('/saveLike',{
                id : this.post_id
              })
                .then(response => {
                  if (response.data == 'deleted') {
                    this.likeCount -= 1;
                  }
                  else {
                    this.likeCount += 1;
                  }

                  //this.blog = response.data;
                  console.log(response);
                })
                .catch(function(error){
                  console.log(error);
                });
            } // if closing
            else {
              window.location = 'login';
            }

          }, //likeit method closing

          deleteIt(id){
            // axios.get('/deletePost/' + id)
            //      .then(response => {
            //        console.log(response); // show if success
            //        this.blog = response.data; //putting data into our post array
            //      })
            //      .catch(function (error) {
            //        console.log(error); // run if we have error
            //      });

            axios.delete('/posts/' + this.post_id)
                        .then(response => {

                            this.blog.splice(id, 1);

                        })
                        .catch(error => {

                        });
          }, //deletepost closing

        } // methods closing

    }
</script>
