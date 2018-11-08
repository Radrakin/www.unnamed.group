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
          <h2>
            About Us
          </h2>
          <p className="text-justify">
            Firstly, we’re not a “unit,” we’re a group of friends who enjoy playing Arma together as the bad guys. Now that’s out of the way, we are the Unnamed Arma Group, an organization for mercenaries who care about nothing but getting the job done and getting paid. We operate with an arsenal more advanced than any other military force on the planet, meaning more opportunities to experience a unique perspective of Arma 3 MILSIM gameplay.
          </p>
        </div>
      </div>
    </div>
  </div>
)
