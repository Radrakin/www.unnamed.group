import CommonHead from '../components/CommonHead'
import Navbar from '../components/Navbar'

export default () => (
  <div>
    <CommonHead
      subtitle={"Home"}
    />
    <Navbar/>
    <div className="container">
      <div id="site-wrap" className="row">
        <div id="box1" className="card mx-auto my-auto rounded-0">
          <h1>
            Unnamed Arma Group
          </h1>
          <h3>
            "No Bullshit" <u>MILSIM</u>
          </h3>
          <br/>
          <div className="row">
            <div className="col"/>
            <div className="col">
              <button id="discordButton" type="button" className="btn btn-primary col" onClick="discordClicked()">
                <img src="https://discordapp.com/assets/192cb9459cbc0f9e73e2591b700f1857.svg"/>
              </button>
            </div>
            <div className="col"/>
          </div>
        </div>
      </div>
    </div>
    <script>
      {
      	function discordClicked() {
      		console.log("Discord button clicked, doing shit...");

      		window.open('https://armapmc.com/discord', '_blank');

      		console.log("Shit done, why are you still here?");
      	}
      }
    </script>
  </div>
)
