import{u as j}from"./layout-69baa60e.js";import{_ as S}from"./AppLayout-6336a29c.js";import{d as u,K as C,L as D,M as T,e as A,b as s,u as B,w as a,F as M,o as N,X as P,a as e,g as l,t as $,i as o}from"./app-5ae7d91e.js";class O{getProductsSmall(){return fetch("/demo/data/products-small.json").then(t=>t.json()).then(t=>t.data)}getProducts(){return fetch("/demo/data/products.json").then(t=>t.json()).then(t=>t.data)}getProductsWithOrdersSmall(){return fetch("/demo/data/products-orders-small.json").then(t=>t.json()).then(t=>t.data)}}const R={class:"grid"},J=e("div",{class:"col-12 lg:col-6 xl:col-3"},[e("div",{class:"card mb-0"},[e("div",{class:"flex justify-content-between mb-3"},[e("div",null,[e("span",{class:"block text-500 font-medium mb-3"},"Orders"),e("div",{class:"text-900 font-medium text-xl"},"152")]),e("div",{class:"flex align-items-center justify-content-center bg-blue-100 border-round",style:{width:"2.5rem",height:"2.5rem"}},[e("i",{class:"pi pi-shopping-cart text-blue-500 text-xl"})])]),e("span",{class:"text-green-500 font-medium"},"24 new "),e("span",{class:"text-500"},"since last visit")])],-1),L=e("div",{class:"col-12 lg:col-6 xl:col-3"},[e("div",{class:"card mb-0"},[e("div",{class:"flex justify-content-between mb-3"},[e("div",null,[e("span",{class:"block text-500 font-medium mb-3"},"Revenue"),e("div",{class:"text-900 font-medium text-xl"},"$2.100")]),e("div",{class:"flex align-items-center justify-content-center bg-orange-100 border-round",style:{width:"2.5rem",height:"2.5rem"}},[e("i",{class:"pi pi-map-marker text-orange-500 text-xl"})])]),e("span",{class:"text-green-500 font-medium"},"%52+ "),e("span",{class:"text-500"},"since last week")])],-1),V=e("div",{class:"col-12 lg:col-6 xl:col-3"},[e("div",{class:"card mb-0"},[e("div",{class:"flex justify-content-between mb-3"},[e("div",null,[e("span",{class:"block text-500 font-medium mb-3"},"Customers"),e("div",{class:"text-900 font-medium text-xl"},"28441")]),e("div",{class:"flex align-items-center justify-content-center bg-cyan-100 border-round",style:{width:"2.5rem",height:"2.5rem"}},[e("i",{class:"pi pi-inbox text-cyan-500 text-xl"})])]),e("span",{class:"text-green-500 font-medium"},"520 "),e("span",{class:"text-500"},"newly registered")])],-1),F=e("div",{class:"col-12 lg:col-6 xl:col-3"},[e("div",{class:"card mb-0"},[e("div",{class:"flex justify-content-between mb-3"},[e("div",null,[e("span",{class:"block text-500 font-medium mb-3"},"Comments"),e("div",{class:"text-900 font-medium text-xl"},"152 Unread")]),e("div",{class:"flex align-items-center justify-content-center bg-purple-100 border-round",style:{width:"2.5rem",height:"2.5rem"}},[e("i",{class:"pi pi-comment text-purple-500 text-xl"})])]),e("span",{class:"text-green-500 font-medium"},"85 "),e("span",{class:"text-500"},"responded")])],-1),Y={class:"col-12 xl:col-6"},q={class:"card"},E=e("h5",null,"Recent Sales",-1),U=["src","alt"],W={class:"card"},K={class:"flex justify-content-between align-items-center mb-5"},H=e("h5",null,"Best Selling Products",-1),I=e("ul",{class:"list-none p-0 m-0"},[e("li",{class:"flex flex-column md:flex-row md:align-items-center md:justify-content-between mb-4"},[e("div",null,[e("span",{class:"text-900 font-medium mr-2 mb-1 md:mb-0"},"Space T-Shirt"),e("div",{class:"mt-1 text-600"},"Clothing")]),e("div",{class:"mt-2 md:mt-0 flex align-items-center"},[e("div",{class:"surface-300 border-round overflow-hidden w-10rem lg:w-6rem",style:{height:"8px"}},[e("div",{class:"bg-orange-500 h-full",style:{width:"50%"}})]),e("span",{class:"text-orange-500 ml-3 font-medium"},"%50")])]),e("li",{class:"flex flex-column md:flex-row md:align-items-center md:justify-content-between mb-4"},[e("div",null,[e("span",{class:"text-900 font-medium mr-2 mb-1 md:mb-0"},"Portal Sticker"),e("div",{class:"mt-1 text-600"},"Accessories")]),e("div",{class:"mt-2 md:mt-0 ml-0 md:ml-8 flex align-items-center"},[e("div",{class:"surface-300 border-round overflow-hidden w-10rem lg:w-6rem",style:{height:"8px"}},[e("div",{class:"bg-cyan-500 h-full",style:{width:"16%"}})]),e("span",{class:"text-cyan-500 ml-3 font-medium"},"%16")])]),e("li",{class:"flex flex-column md:flex-row md:align-items-center md:justify-content-between mb-4"},[e("div",null,[e("span",{class:"text-900 font-medium mr-2 mb-1 md:mb-0"},"Supernova Sticker"),e("div",{class:"mt-1 text-600"},"Accessories")]),e("div",{class:"mt-2 md:mt-0 ml-0 md:ml-8 flex align-items-center"},[e("div",{class:"surface-300 border-round overflow-hidden w-10rem lg:w-6rem",style:{height:"8px"}},[e("div",{class:"bg-pink-500 h-full",style:{width:"67%"}})]),e("span",{class:"text-pink-500 ml-3 font-medium"},"%67")])]),e("li",{class:"flex flex-column md:flex-row md:align-items-center md:justify-content-between mb-4"},[e("div",null,[e("span",{class:"text-900 font-medium mr-2 mb-1 md:mb-0"},"Wonders Notebook"),e("div",{class:"mt-1 text-600"},"Office")]),e("div",{class:"mt-2 md:mt-0 ml-0 md:ml-8 flex align-items-center"},[e("div",{class:"surface-300 border-round overflow-hidden w-10rem lg:w-6rem",style:{height:"8px"}},[e("div",{class:"bg-green-500 h-full",style:{width:"35%"}})]),e("span",{class:"text-green-500 ml-3 font-medium"},"%35")])]),e("li",{class:"flex flex-column md:flex-row md:align-items-center md:justify-content-between mb-4"},[e("div",null,[e("span",{class:"text-900 font-medium mr-2 mb-1 md:mb-0"},"Mat Black Case"),e("div",{class:"mt-1 text-600"},"Accessories")]),e("div",{class:"mt-2 md:mt-0 ml-0 md:ml-8 flex align-items-center"},[e("div",{class:"surface-300 border-round overflow-hidden w-10rem lg:w-6rem",style:{height:"8px"}},[e("div",{class:"bg-purple-500 h-full",style:{width:"75%"}})]),e("span",{class:"text-purple-500 ml-3 font-medium"},"%75")])]),e("li",{class:"flex flex-column md:flex-row md:align-items-center md:justify-content-between mb-4"},[e("div",null,[e("span",{class:"text-900 font-medium mr-2 mb-1 md:mb-0"},"Robots T-Shirt"),e("div",{class:"mt-1 text-600"},"Clothing")]),e("div",{class:"mt-2 md:mt-0 ml-0 md:ml-8 flex align-items-center"},[e("div",{class:"surface-300 border-round overflow-hidden w-10rem lg:w-6rem",style:{height:"8px"}},[e("div",{class:"bg-teal-500 h-full",style:{width:"40%"}})]),e("span",{class:"text-teal-500 ml-3 font-medium"},"%40")])])],-1),X={class:"col-12 xl:col-6"},z={class:"card"},G=e("h5",null,"Sales Overview",-1),Q={class:"card"},Z={class:"flex align-items-center justify-content-between mb-4"},ee=e("h5",null,"Notifications",-1),te=e("span",{class:"block text-600 font-medium mb-3"},"TODAY",-1),se=e("ul",{class:"p-0 mx-0 mt-0 mb-4 list-none"},[e("li",{class:"flex align-items-center py-2 border-bottom-1 surface-border"},[e("div",{class:"w-3rem h-3rem flex align-items-center justify-content-center bg-blue-100 border-circle mr-3 flex-shrink-0"},[e("i",{class:"pi pi-dollar text-xl text-blue-500"})]),e("span",{class:"text-900 line-height-3"},[l("Richard Jones "),e("span",{class:"text-700"},[l("has purchased a blue t-shirt for "),e("span",{class:"text-blue-500"},"79$")])])]),e("li",{class:"flex align-items-center py-2"},[e("div",{class:"w-3rem h-3rem flex align-items-center justify-content-center bg-orange-100 border-circle mr-3 flex-shrink-0"},[e("i",{class:"pi pi-download text-xl text-orange-500"})]),e("span",{class:"text-700 line-height-3"},[l("Your request for withdrawal of "),e("span",{class:"text-blue-500 font-medium"},"2500$"),l(" has been initiated.")])])],-1),le=e("span",{class:"block text-600 font-medium mb-3"},"YESTERDAY",-1),ne=e("ul",{class:"p-0 m-0 list-none"},[e("li",{class:"flex align-items-center py-2 border-bottom-1 surface-border"},[e("div",{class:"w-3rem h-3rem flex align-items-center justify-content-center bg-blue-100 border-circle mr-3 flex-shrink-0"},[e("i",{class:"pi pi-dollar text-xl text-blue-500"})]),e("span",{class:"text-900 line-height-3"},[l("Keyser Wick "),e("span",{class:"text-700"},[l("has purchased a black jacket for "),e("span",{class:"text-blue-500"},"59$")])])]),e("li",{class:"flex align-items-center py-2 border-bottom-1 surface-border"},[e("div",{class:"w-3rem h-3rem flex align-items-center justify-content-center bg-pink-100 border-circle mr-3 flex-shrink-0"},[e("i",{class:"pi pi-question text-xl text-pink-500"})]),e("span",{class:"text-900 line-height-3"},[l("Jane Davis "),e("span",{class:"text-700"},"has posted a new questions about your product.")])])],-1),ce={__name:"HomeView",setup(x){const{isDarkTheme:t}=j(),f=u(null),h=C({labels:["January","February","March","April","May","June","July"],datasets:[{label:"First Dataset",data:[65,59,80,81,56,55,40],fill:!1,backgroundColor:"#2f4860",borderColor:"#2f4860",tension:.4},{label:"Second Dataset",data:[28,48,40,19,86,27,90],fill:!1,backgroundColor:"#00bb7e",borderColor:"#00bb7e",tension:.4}]}),p=u([{label:"Add New",icon:"pi pi-fw pi-plus"},{label:"Remove",icon:"pi pi-fw pi-minus"}]),d=u(null),g=new O;D(()=>{g.getProductsSmall().then(n=>f.value=n)});const v=n=>n.toLocaleString("en-US",{style:"currency",currency:"USD"}),w=()=>{d.value={plugins:{legend:{labels:{color:"#495057"}}},scales:{x:{ticks:{color:"#495057"},grid:{color:"#ebedef"}},y:{ticks:{color:"#495057"},grid:{color:"#ebedef"}}}}},y=()=>{d.value={plugins:{legend:{labels:{color:"#ebedef"}}},scales:{x:{ticks:{color:"#ebedef"},grid:{color:"rgba(160, 167, 181, .3)"}},y:{ticks:{color:"#ebedef"},grid:{color:"rgba(160, 167, 181, .3)"}}}}};return T(t,n=>{n?y():w()},{immediate:!0}),(n,c)=>{const r=o("Column"),m=o("Button"),_=o("DataTable"),b=o("Menu"),k=o("Chart");return N(),A(M,null,[s(B(P),{title:"Dashboard"}),s(S,null,{default:a(()=>[e("div",R,[J,L,V,F,e("div",Y,[e("div",q,[E,s(_,{value:f.value,rows:5,paginator:!0,responsiveLayout:"scroll"},{default:a(()=>[s(r,{style:{width:"15%"}},{header:a(()=>[l(" Image ")]),body:a(i=>[e("img",{src:"/demo/images/product/"+i.data.image,alt:i.data.image,width:"50",class:"shadow-2"},null,8,U)]),_:1}),s(r,{field:"name",header:"Name",sortable:!0,style:{width:"35%"}}),s(r,{field:"price",header:"Price",sortable:!0,style:{width:"35%"}},{body:a(i=>[l($(v(i.data.price)),1)]),_:1}),s(r,{style:{width:"15%"}},{header:a(()=>[l(" View ")]),body:a(()=>[s(m,{icon:"pi pi-search",type:"button",class:"p-button-text"})]),_:1})]),_:1},8,["value"])]),e("div",W,[e("div",K,[H,e("div",null,[s(m,{icon:"pi pi-ellipsis-v",class:"p-button-text p-button-plain p-button-rounded",onClick:c[0]||(c[0]=i=>n.$refs.menu2.toggle(i))}),s(b,{ref:"menu2",popup:!0,model:p.value},null,8,["model"])])]),I])]),e("div",X,[e("div",z,[G,s(k,{type:"line",data:h,options:d.value},null,8,["data","options"])]),e("div",Q,[e("div",Z,[ee,e("div",null,[s(m,{icon:"pi pi-ellipsis-v",class:"p-button-text p-button-plain p-button-rounded",onClick:c[1]||(c[1]=i=>n.$refs.menu1.toggle(i))}),s(b,{ref:"menu1",popup:!0,model:p.value},null,8,["model"])])]),te,se,le,ne])])])]),_:1})],64)}}};export{ce as default};