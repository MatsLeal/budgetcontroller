Vue.config.devtools = true

Vue.component('months',{
    template : `
    <div class="columns is-mobile is-multiline is-centered">
    <slot></slot>
    </div>
    `
});

Vue.component('month',{

    props : {
        name : {required : true},
        incoming : { required : true},
        saved : { required : true},
        ants : { required : true},
    },

    template : `
  <div class="column  ">
    <div class="card">
  <header class="card-header">
    <p class="card-header-title ">
        {{  name  }}
    </p>
  </header>
  <div class="card-content">
    <div class="content">

    <span class="tag is-success">
        <p> Incoming : {{incoming }}</p>
    </span>
    <br>
    <br>

        <span class="tag is-warning">

            <p> Saved : {{saved}}</p>
        </span>
    <br>
    <br>


        <span class="tag is-danger">
            <p> Ants : {{ants}}</p>
        </span>

    <br>
    <br>


        <span   class="tag " :class=" state" >

        <p> Balance : {{balance}}</p>

        </span>
    </div>
  </div>
  <footer class="card-footer">
    <a href="#" class="card-footer-item button is-info">More</a>
  </footer>
</div>
  </div>
`,

    computed:
    {
        state()
        {
            if(this.ok)
            {

            return 'is-danger';
            }

            return 'is-info';
        },


        balance()
            {
                return  +this.incoming- +( +this.saved +  +this.ants);
            }
    },

    data()
    {
        ok: false;
    },

    created()
    {

        console.log(this.name);
        console.log(this.incoming);
        console.log( +this.incoming <  +( +this.saved+ +this.ants));
       if( +this.incoming  < +( +this.saved + +this.ants)) 
        {
         this.ok=true;
        }

    }
});













Vue.component('modal',{

    template : `<div class="modal is-active">
  <div class="modal-background"></div>
  <div class="modal-content">
    <div class="box">
        <p> Message </p>
    </div>
  </div>
  <button class="modal-close is-large" aria-label="close" @click="$emit('close')"></button>
</div>`
});



Vue.component('tabs',{

    template: `
    <div>
    <div class="tabs">
    <ul>
    <li v-for="tab in tabs" :class=" { 'is-active' : tab.isActive }  ">
        <a @click="selectTab(tab)"> {{tab.name}}</a>
    </li>
    </ul>
    </div>

    <div class="tab-details">
    <slot></slot>
    </div>
    </div>
    `,

    data ()
    {
        return  { tabs : []  } ;
    },


    created ()
    {
        this.tabs = this.$children;
    },
    
    methods:
    {
        selectTab(selectedTab){

            this.tabs.forEach( tab => {
                tab.isActive = (tab.name == selectedTab.name);
            });

        }
    }

});




Vue.component('tab',{
    template : `
     <div v-show="isActive">
         <slot ></slot>
     </div>
    `,

    props: {
        name : { required : true },
        selected : { default : false }
    },

    data ()
    {

        return {
        isActive :false
        }
    },

    mounted(){
        this.isActive= this.selected;
    }
});












Vue.component('message',{
    props : ['title','body'] ,
    
    data ()
    {
        return {
            isVisible:true, hover:'Hide'
        };
    },
    
    template: `
        <article class="message" >
  <div class="message-header">
    <p> {{title}}</p>
    <button class="delete"  :title=this.hover aria-label="delete" @click="hideModal">  </button>
  </div>
  <div class="message-body" v-show='isVisible'>
    {{body}}
  </div>
</article>`,

   methods :
    {
        hideModal()
        {
            if(this.isVisible)
            {
                this.isVisible=false;
                this.hover='Mostrar';
            }
            else{
                this.isVisible=true;
                this.hover='Ocultar';
            }
        }
    }

});



 var app = new Vue ({
 el: '#root',
    data:{
        showModal:false
    }
});

