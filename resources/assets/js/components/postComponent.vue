<template>
  <div class="row status-part text-center">
    <div class="col-sm-12 ">
      <!-- FORM SECTION -->
      <form class="post-box-n" @submit.prevent="create">
        <div class="form-group">
          <textarea type="text" name="body" value="" placeholder="Say Something Here" class="form-control status"  v-model="task.body"></textarea>
          <!-- <label for="" class="label status-label">
              <img src="https://femina.wwmindia.com/photogallery/2017/jul/photogallery1_1499326937_760x568.jpg" alt="" class="img-responsive img-circle">
             "Say Something Here"
           </label> -->
        </div>

        <div class="form-group">
          <div class="col-md-10 text-right image-upload-bar col-sm-10 col-xs-10">
            <input type="file" name="" value="" class="form-control image-upload" id="file-input" v-on:change="onImageChange">
            <img class="preview" :src="this.task.image">
            <label for="file-input"><i class="fa fa-images"></i></label>
          </div>
        </div>
        <div class="form-group">
          <!-- <button class="btn btn-success btn-block" @click="uploadImage">Upload Image</button> -->
          <div class="col-md-2 post-button col-sm-2 col-xs-2">
            <!-- <input type="submit" name="" value="Post" class="btn btn-green"> -->
            <button type="button" name="button" class="btn btn-green" @click="create">Post</button>
          </div>
        </div>
      </form>
      <!-- FORM SECTION -->

      <!-- TABS STARTS -->
      <div class="tab-content">
        <!-- RECENT SECTION START -->
        <div class="scroll-div-n tab-pane fade in active" id="recents" >
          <div class="recentbox text-left "   v-for="task in tasks" :key="task.id" :task="task">

            <div>

              <div class="dropdown dbz" @click.prevent="myfunc()">
                <button class="dropdown-toggle" type="button" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></button>
                <ul class="dropdown-menu dbzm">
                  <li>
                    <a href="" @click.prevent="remove(task)">
                      <small>Delete</small>
                      <i class="fa fa-trash-o"></i>
                    </a>
                  </li>
                </ul>
              </div>

              <div class="row">
                <div class="col-md-2 image-col-n">
                  <img :src="'/img/' + task.user.pic" alt="" class="img-responsive img-circle">
                </div>
                <div class="col-md-10 pl-0 poststatus-n">
                  <p class="name">{{task.user.name}} <span class="time">{{task.created_at | myOwnTime }}</span></p>
                  <p class="taskbody">{{task.body}} </p>
                  <img v-if="task.image" :src="'/img/' + task.image" alt="" class="img-responsive">
                </div>
              </div>
              <!-- Bottom Buttons -->
              <div class="row bottom-buttons">
                <div class="col-md-6 col-sm-3 col-xs-3" v-if="task.likes">
                  <span class="all-likes">{{ task.likes.length }}</span>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-3 socialbtnslike-n">
                  <span class="like">
                    <a href="" @click.prevent="likeIt(task)">
                      Like
                    </a>
                  </span>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-3 socialbtns-n">
                  <span class="dislike">
                    <a href="" @click.prevent="">
                      Dislike
                    </a>
                  </span>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-3 socialbtns-n">
                  <span class="share">
                    <a href="" @click.prevent="">
                      Share
                    </a>
                  </span>
                </div>
              </div>
            </div>

          </div>
          <!-- Load More -->
          <button class="btn btn-green form-control loadmorebutton" @click="handleButton">Load more</button>


        </div>
        <!-- RECENT SECTION END -->

        <!-- TRENDING SECTION START -->
        <div class="scroll-div-n tab-pane fade" id="trend">
          <div class="recentbox text-left "   v-for="task in trendingtasks" :key="'A' + task.id" >

            <div>
              <div class="dropdown dbz" @click.prevent="myfuncs()">
                <button class="dropdown-toggle" type="button" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></button>
                <ul class="dropdown-menu dbznm">
                  <li>
                    <a href="" @click.prevent="remove(task)">
                      <small>Delete</small>
                      <i class="fa fa-trash-o"></i>
                    </a>
                  </li>
                </ul>
              </div>
              <div class="row">
                <div class="col-md-2 image-col-n">
                  <img v-if="task.user.pic" :src="'/img/' + task.user.pic" alt="" class="img-responsive img-circle">
                </div>
                <div class="col-md-10 pl-0 poststatus-n">
                  <p class="name">{{task.user.name}} <span class="time">{{task.created_at | myOwnTime }}</span></p>
                  <p class="taskbody">{{task.body}}</p>
                  <img v-if="task.image" :src="'/img/' + task.image" alt="" class="img-responsive" width="80px" height="80px;">
                </div>
              </div>
              <!-- Bottom Buttons -->
              <div class="row bottom-buttons">
                <div class="col-md-6 col-sm-3 col-xs-3">
                  <span class="all-likes">{{ task.likes.length }}</span>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-3">
                  <span class="like">
                    <a href="" @click.prevent="likeIt(task)">
                      Like
                    </a>
                  </span>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-3">
                  <span class="dislike">
                    <a href="" @click.prevent="">
                      Dislike
                    </a>
                  </span>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-3">
                  <span class="share">
                    <a href="" @click.prevent="">
                      Share
                    </a>
                  </span>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- TRENDING SECTION END -->
      </div>
      <!-- TABS END -->


    </div>
  </div>
</template>

<script>
    export default {
      mounted() {

          this.fetchData()
      },
        data(){
          return {
            message: '',
            blog:[],
            tasks:[],
            alltasks:[],
            trendingtasks:[],
            moreMsgFetched: false,

            task:{
              likeCount:0,
              image:'',
              body:''

            }
          }
        },

        props:[
          'body','id','created_at','name','post_id','login','likes'
        ],

        created(){
          //this.task.likeCount= this.likes;
        },

        methods:{
          myfunc(){

            // var dp = document.getElementsByClassName('dbzm');
            // var db = document.querySelector('.dbz');
            var tst = event.target.parentNode.parentNode.childNodes[2];
            console.log(tst);
            // var tst = this.parentNode.children[1];
            // var dpn = db.children[1];
            // console.log(dpn);
            if(tst.style.display == "block"){
              tst.style.display = "none";
              console.log(tst.style.display);
            }else{
              tst.style.display = "block";
              console.log(tst.style.display);
            }
          },
          myfuncs(){

            var dp = event.target.parentNode.parentNode.childNodes[2];
            console.log(dp);
            if(dp.style.display == "block"){
              dp.style.display = "none";
              console.log(dp.style.display);
            }else{
              dp.style.display = "block";
              console.log(dp.style.display);
            }
          },
          hideLabel(){
            var labelz = document.getElementsByClassName('status-label');
            labelz[0].style.display = "none";
          },
          likeIt(task){

              console.log(this.task.likeCount);
              axios.post('/saveLike/' + task.id)
                .then(response => {
                  if (response.data == 'deleted') {
                    this.task.likeCount -= 1;
                  }
                  else {
                    this.task.likeCount += 1;
                  }

                  //this.blog = response.data;
                  console.log(response);
                })
                .catch(function(error){
                  console.log(error);
                });
             // if closing


          }, //likeit method closing

          onImageChange(e) {
            console.log(e.target.files[0]);
            var reader = new FileReader;
            reader.readAsDataURL(e.target.files[0]);
            reader.onload = (e) =>{
                  this.task.image = e.target.result;
            };
            console.log(this.task);
            // var files = e.target.files || e.dataTransfer.files;
            // this.createImage(files[0]); // files the image/ file value to our createImg function
            },
            createImage(file) {
              // we will preview our image before upload
              var image = new Image;

              var reader = new FileReader;
              reader.onload = (e) =>{
                    this.task.image = e.target.result;
              };
              console.log(this.task.image);
              reader.readAsDataURL(file); //here 'file' is the file which we used as parameter in createimg above
            },
            uploadImage(){
              // axios.post('/posts', {
              //   featured_image: this.image,
              //   content: this.content
              // })
              // .then( (response) => {
              //   console.log('saved successfully'); // show if success
              //   this.image= "";
              //   this.content = "";
              //   if(response.status===200){
              //     app.posts = response.data;
              //   }
              // })
              // .catch(function (error) {
              //   console.log(error); // run if we have error
              // });
                axios.post('/posts',this.task)
                .then(response => {
                   console.log(response);
                });
            },

          // get all posts
          fetchData(){

            axios.get('/getPosts')
                .then(response => {

                  this.alltasks = response.data;
                  this.tasks = this.alltasks.splice(0, 7);

                  Vue.filter('myOwnTime', function(value){
                     return moment(value).calendar();
                   });
                  console.log(response);
                })
                .catch(function(error){
                  console.log(error);
                });

                axios.get('/getTrendingPosts')
                    .then(response => {
                      this.trendingtasks = response.data;
                      Vue.filter('myOwnTime', function(value){
                         return moment(value).calendar();
                       });
                      console.log(response);
                    })
                    .catch(function(error){
                      console.log(error);
                    });
          },

          handleButton: function () {
            // if(!this.moreMsgFetched){
            //     axios.get('/getPosts').then((response) => {
            //       this.alltasks = response.data;
            //       this.tasks = this.alltasks.splice(0, 3);
            //       this.moreMsgFetched = true;
            //       console.log(this.moreMsgFetched);
            //       console.log(this.tasks);
            //     });
            // }
            // var nextMsgs = this.alltasks.splice(0, 10);
            // //if you wnt to add 10 more messages to messages array
            // this.tasks.push(nextMsgs);

        },


          create(){
            axios.post('/posts',this.task)
                .then(response => {
                  this.tasks.unshift(response.data);
                  this.task.body='';
                  console.log(response);
                  this.message= 'Success';
                })
                .catch(function(error){
                  console.log(error);
                });
          },

          remove(task){
            axios.delete('/posts/' + task.id)
                .then(response => {
                  const taskindex = this.tasks.indexOf(task);
                  this.tasks.splice(taskindex, 1);

                  console.log(response);
                })
                .catch(function(error){
                  console.log(error);
                });
          }


        } // methods closing

    }
</script>
