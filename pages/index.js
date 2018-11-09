import CommonHead from '../components/CommonHead'
import Navbar from '../components/Navbar'
import DiscordButton from '../components/DiscordButton'

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
              <DiscordButton />
            </div>
            <div className="col"/>
          </div>
        </div>
      </div>
    </div>
  </div>
)
