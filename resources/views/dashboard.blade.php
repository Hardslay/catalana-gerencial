<x-app-layout>


  <!--  <div class="col-md-4">
        <div class="card">
            <img
              width="400" height="250" src="http://ccpcatalana.com/assets/img/informacion.jpg"class="card-img-top" alt="..."
            />
            <div class="card-body">
               <h5 class="card-title">Card title</h5>
               <p class="card-text">
               </p>
               <a href="#!" class="btn btn-primary">Button</a>
            </div>
        </div>
    </div>-->

    <!--  <div class="card">
          <div class="card-body">
          <form action="{{route('getAllInformation')}}">
              <button type="submit">Traer info</button>
          </form>
          </div>
      </div>-->

    <div class="col-md-4">
        <livewire:data.data/>
    </div>



</x-app-layout>
