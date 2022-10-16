
import React, { useEffect, useState } from "react";
import Card from '@mui/material/Card';
import CardActions from '@mui/material/CardActions';
import CardContent from '@mui/material/CardContent';
import Button from '@mui/material/Button';
import Typography from '@mui/material/Typography';

export default function AdList() {

    const [ads, setAds] = useState([]);
    useEffect(() => {
      AdsGet()
    }, [])
    
    const AdsGet = () => {
      fetch("https://127.0.01:8001/api/annonces")
        .then(res => res.json())
        .then(
          (result) => {
            setAds(result['hydra:member'])
          }
        )
    }

    return (
        <div>
            {ads.map((ad, item) => (
        <Card sx={{ minWidth: 275 }}>
      <CardContent key={ad.id}>
        <Typography  sx={{ fontSize: 14 }} color="text.secondary" gutterBottom>{ad.title}
        </Typography>
         <Typography variant="h5" component="div">
         {ad.summary}
        </Typography>
        <Typography sx={{ mb: 1.5 }} color="text.secondary">
        {ad.contrat}
        </Typography>
        <Typography variant="body2">
        {ad.wage}
          <br />
          {ad.summary}
        </Typography>
      </CardContent>
      <CardActions>
        <Button onClick={() => ads(ad.description)}>Learn More</Button>
      </CardActions>
    </Card>
          ))}
    </div>
  );
}
