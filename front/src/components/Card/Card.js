import Card from 'react-bootstrap/Card';
import * as ReactBootStrap from 'react-bootstrap'
import "bootstrap/dist/css/bootstrap.min.css";

export default function CardAds(props) {
   
  const displayAds = (props) => {
    const {ads} = props;
    console.log(ads);
    if (ads.lengh > 0 ) {
        return (
            ads.map((ad, index) => {
                console.log(ad);
                return (
                    <div className='ad' key={ad.id}>
                        <h3 className='ad_title'>{ad.title}</h3>
                        <p className='ad_desc'>{ad.description}</p>
                        <h3 className='ad_wage'>{ad.wage}</h3>
                    </div>
                )
            })
        )
    } else {
        return (<h3>No ads yet</h3>)
    }
    }

 

  return (
        
    <>
        {displayAds(props)}
    </>


  )
}