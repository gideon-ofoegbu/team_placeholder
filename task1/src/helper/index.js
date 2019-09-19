export const serverRequest = (method = 'GET', route = '', data = {}) => {
    const base_url = 'https://akuretravellersinfo.xyz/api/hub/';
    
    //create form data
    if(method == "GET"){
        return fetch(base_url + route, {
            mode: 'cors',
            method: method,
        })
        .then(response => response.json());
    }

    
    const full_url = `${base_url}${route}.php`;
    console.log('call api ->',full_url, data);
    let formData = new FormData();
    for(const item in data){
        formData.append(item, data[item]);
    }
    return fetch(full_url, {
        mode: 'cors',
        method: method,
        body: formData
    })
    .then(response => response.json());
}

export const displayDate = ()=> {
	const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nove','Dec'];
	const d = new Date();
	return `${d.getDate()} ${months[d.getMonth()]},${d.getFullYear()}`;
}

export const daysInThisMonth = ()=> {
    var now = new Date();
    return new Date(now.getFullYear(), now.getMonth()+1, 0).getDate();
}

export const getWeekDates = () => {
    let weekdates = [];
    const curr = new Date(); // get current date
    const first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
    const last = first + 6; // last day is the first day + 6
    
    //loop through and get the actual dates of each day
    for(let day = first; day <= last; day++){
      weekdates.push(new Date(curr.setDate(day)).getDate());
    }
    return weekdates;
}

export const numberWithCommas =(x)=> {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}