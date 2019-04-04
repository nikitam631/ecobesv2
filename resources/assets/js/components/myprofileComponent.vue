<template>
  <div class="row status-part text-center">
    <div class="col-sm-12 ">

      <!-- TAB BUTTONS START -->
      <ul class="nav nav-tabs">
        <!-- <li class="active"><a data-toggle="tab" href="#activity">My Activities</a></li> -->
        <li class="active"><a data-toggle="tab" href="#posts">My Posts</a></li>

      </ul>
      <!-- TAB BUTTONS END -->

      <!-- TABS STARTS -->
      <div class="tab-content">
        <!-- RECENT SECTION START -->
        
        <!-- RECENT SECTION END -->

        <!-- TRENDING SECTION START -->
        <div class="scroll-div-n tab-pane fade in active" id="posts">
          <div class="recentbox text-left "   v-for="task in tasks" :key="task.id" :task="task" >

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
                  <p>{{task.body}}</p>
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

            blog:[],
            tasks:[],
            trendingtasks:[],


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

          // get all posts
          fetchData(){
            axios.get('/getMyPosts')
                .then(response => {
                  this.tasks = response.data;
                  Vue.filter('myOwnTime', function(value){
                     return moment(value).calendar();
                   });
                  console.log(response);
                })
                .catch(function(error){
                  console.log(error);
                });

                //get trending posts
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
