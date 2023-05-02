import{_ as X,G as Y,d as h,H as Z,I as P,e as m,b as t,u as U,w as i,F as C,o as v,X as ee,a as l,z as ae,g as p,t as u,n as z,f as S,h as q,J as M,O as R,i as _,p as le,m as te}from"./app-5ae7d91e.js";import{_ as se}from"./AppLayout-6336a29c.js";import"./layout-69baa60e.js";const d=f=>(le("data-v-73bae301"),f=f(),te(),f),oe={class:"grid"},ie={class:"col-12"},ne={class:"card"},ue={class:"list-none p-0 m-0 flex align-items-center font-medium mb-3"},de=d(()=>l("li",{class:"px-2"},[l("i",{class:"pi pi-angle-right text-500 line-height-3"})],-1)),re=d(()=>l("li",null,[l("span",{class:"text-900 line-height-3"},"Magazines")],-1)),ce={class:"my-2"},me=["src","alt"],ve={class:"p-3"},pe=["src","alt"],_e=["src"],be={class:"field"},he=d(()=>l("label",{for:"name"},"Name",-1)),fe={key:0,class:"p-invalid"},ge={class:"field"},ye=d(()=>l("label",{for:"inventoryStatus",class:"mb-3"},"Inventory Status",-1)),Se={key:0,class:"p-invalid"},Ve={class:"formgrid grid"},we={class:"field col"},xe=d(()=>l("label",{for:"price"},"Price",-1)),ze={key:0,class:"p-invalid"},ke={class:"field col"},Ce=d(()=>l("label",{for:"quantity"},"Quantity",-1)),Me={key:0,class:"p-invalid"},Ie={class:"field"},Ne=d(()=>l("label",{class:"mb-3"},"Category",-1)),De={class:"formgrid grid"},Te={class:"field-radiobutton col-6"},Ue={for:"category1"},qe={class:"field"},Re=d(()=>l("label",{class:"mb-3"},"Tags",-1)),Le={key:0,class:"p-1"},Be={class:"field"},Ae=d(()=>l("label",{class:"mb-3"},"writer",-1)),Ee={class:"field"},Fe=d(()=>l("label",{class:"mb-3"},"publisher",-1)),Oe={class:"field"},$e=d(()=>l("label",{class:"mb-3"},"translator",-1)),je={class:"flex align-items-center justify-content-center"},Qe=d(()=>l("i",{class:"pi pi-exclamation-triangle mr-3",style:{"font-size":"2rem"}},null,-1)),We={key:0},Ge={__name:"MagazinesView",props:{magazines:Object},setup(f){const L=f,g=Y(),y=h(!1),V=h(!1);h(!1);const e=h({});h(null),h(null);const B=h({}),r=h(!1),w=h([]);Z(()=>{O()});const k=o=>o.toLocaleString("fa-IR",{style:"currency",currency:"IRR"}),A=()=>{y.value=!1,r.value=!1},E=o=>{e.value=o,V.value=!0},F=o=>{M.delete(route("magazines.destroy",[[o.id]])).then(s=>{V.value=!1,g.add({severity:"success",summary:"Successful ",detail:"Magazine Deleted",life:3e3}),R.reload()}).catch(s=>{g.add({severity:"error",summary:"Error",detail:s.message,life:3e3})})},O=()=>{B.value={global:{value:null,matchMode:P.CONTAINS}}},$=()=>{e.value={},r.value=!1,y.value=!0},I=()=>{e.value.inventoryStatus=e.value.inventoryStatus.label||e.value.inventoryStatus,e.value.magazine=e.value.magazine.id,e.value.publisher=e.value.publisher.id,e.value.translator=e.value.translator.id,e.value.tags&&(e.value.tag=[],e.value.tags.forEach(o=>{e.value.tag.push(o.id)}),delete e.value.tags)},j=()=>{r.value=!0,e.value.name&&e.value.name.trim()&&(e.value.id?(I(),M.put(route("magazines.update",[e.value.id,e.value])).then(o=>{console.log(o),y.value=!1,e.value={},g.add({severity:"success",summary:"Successful",detail:"Magazine Created",life:3e3})}).catch(o=>{g.add({severity:"error",summary:"Error",detail:o.message,life:3e3})})):(I(),M.post(route("magazines.store",[e.value])).then(o=>{y.value=!1,e.value={},g.add({severity:"success",summary:"Successful",detail:"Magazine Created",life:3e3}),R.reload()}).catch(o=>{g.add({severity:"error",summary:"Error",detail:o.message,life:3e3})})))},Q=()=>{w.value=L.magazines.filter(o=>o.id)},W=()=>{w.value=null};return(o,s)=>{const b=_("Button"),G=_("Toolbar"),c=_("Column"),N=_("DataTable"),H=_("InputText"),x=_("Dropdown"),D=_("InputNumber"),J=_("RadioButton"),K=_("MultiSelect"),T=_("Dialog");return v(),m(C,null,[t(U(ee),{title:"Magazines"}),t(se,null,{default:i(()=>[l("div",oe,[l("div",ie,[l("div",ne,[l("ul",ue,[l("li",null,[t(U(ae),{href:"/dashboard",class:"text-500 no-underline line-height-3 cursor-pointer"},{default:i(()=>[p("dashboard")]),_:1})]),de,re]),t(G,{class:"mb-4"},{start:i(()=>[l("div",ce,[t(b,{label:"New",icon:"pi pi-plus",class:"p-button-success mr-2",onClick:$})])]),_:1}),t(N,{value:f.magazines,expandedRows:w.value,"onUpdate:expandedRows":s[0]||(s[0]=a=>w.value=a),dataKey:"id",responsiveLayout:"scroll",paginator:!0,rows:10},{header:i(()=>[l("div",null,[t(b,{icon:"pi pi-plus",label:"Expand All",onClick:Q,class:"mr-2 mb-2"}),t(b,{icon:"pi pi-minus",label:"Collapse All",onClick:W,class:"mb-2"})])]),expansion:i(a=>[l("div",ve,[l("h5",null,"Magazines for "+u(a.data.name),1),t(N,{value:a.data.books,responsiveLayout:"scroll"},{default:i(()=>[t(c,{field:"id",header:"Id",sortable:!0},{body:i(n=>[p(u(n.data.id),1)]),_:2},1024),t(c,{field:"name",header:"Name",sortable:!0},{body:i(n=>[p(u(n.data.name),1)]),_:2},1024),t(c,{field:"thumbline",header:"Thumbline"},{body:i(n=>[l("img",{src:n.data.thumbline,alt:n.data.thumbline,class:"shadow-2",width:"100"},null,8,pe)]),_:2},1024),t(c,{field:"price",header:"Price",sortable:!0},{body:i(n=>[p(u(k(n.data.price)),1)]),_:2},1024),t(c,{field:"writer",header:"Writer",sortable:!0},{body:i(n=>[p(u(k(n.data.writer.name)),1)]),_:2},1024)]),_:2},1032,["value"])])]),default:i(()=>[t(c,{expander:!0,headerStyle:"min-width: 3rem"}),t(c,{field:"name",header:"Name",sortable:!0},{body:i(a=>[p(u(a.data.name),1)]),_:1}),t(c,{header:"Image"},{body:i(a=>[l("img",{src:a.data.thumbline,alt:a.data.thumbline,class:"shadow-2",width:"100"},null,8,me)]),_:1}),t(c,{field:"price",header:"Price",sortable:!0},{body:i(a=>[p(u(k(a.data.price)),1)]),_:1}),t(c,{field:"slug",header:"Slug",sortable:!0},{body:i(a=>[p(u(a.data.slug),1)]),_:1}),t(c,{headerStyle:"min-width:10rem;"},{body:i(a=>[t(b,{icon:"pi pi-pencil",class:"p-button-rounded p-button-success mr-2"}),t(b,{icon:"pi pi-trash",class:"p-button-rounded p-button-danger mt-2",onClick:n=>E(a.data)},null,8,["onClick"])]),_:1})]),_:1},8,["value","expandedRows"]),t(T,{visible:y.value,"onUpdate:visible":s[9]||(s[9]=a=>y.value=a),style:{width:"450px"},header:"Magazine Details",modal:!0,class:"p-fluid"},{footer:i(()=>[t(b,{label:"Cancel",icon:"pi pi-times",class:"p-button-text",onClick:A}),t(b,{label:"Save",icon:"pi pi-check",class:"p-button-text",onClick:j})]),default:i(()=>[l("img",{src:e.value.thumbline?e.value.thumbline:"https://fakeimg.pl/320x220/",alt:"magazine image",width:"150",class:"mt-0 mx-auto mb-5 block shadow-2"},null,8,_e),l("div",be,[he,t(H,{id:"name",modelValue:e.value.name,"onUpdate:modelValue":s[1]||(s[1]=a=>e.value.name=a),modelModifiers:{trim:!0},required:"true",autofocus:"",class:z({"p-invalid":r.value&&!e.value.name})},null,8,["modelValue","class"]),r.value&&!e.value.name?(v(),m("small",fe,"Name is required.")):S("",!0)]),l("div",ge,[ye,p(" "+u(e.value.inventoryStatus)+" ",1),t(x,{id:"inventoryStatus",modelValue:e.value.inventoryStatus,"onUpdate:modelValue":s[2]||(s[2]=a=>e.value.inventoryStatus=a),options:o.statuses,optionLabel:"label",placeholder:"Select a Status",class:z({"p-invalid":r.value&&!e.value.inventoryStatus})},null,8,["modelValue","options","class"]),r.value&&!e.value.inventoryStatus?(v(),m("small",Se,"InventoryStatus is required.")):S("",!0)]),l("div",Ve,[l("div",we,[xe,t(D,{id:"price",modelValue:e.value.price,"onUpdate:modelValue":s[3]||(s[3]=a=>e.value.price=a),mode:"currency",currency:"IRR",locale:"fa-IR",class:z({"p-invalid":r.value&&!e.value.price}),required:!0},null,8,["modelValue","class"]),r.value&&!e.value.price?(v(),m("small",ze,"Price is required.")):S("",!0)]),l("div",ke,[Ce,t(D,{id:"quantity",modelValue:e.value.quantity,"onUpdate:modelValue":s[4]||(s[4]=a=>e.value.quantity=a),integeronly:"",class:z({"p-invalid":r.value&&!e.value.quantity})},null,8,["modelValue","class"]),r.value&&!e.value.quantity?(v(),m("small",Me,"Quantity is required.")):S("",!0)])]),l("div",Ie,[Ne,l("div",De,[(v(!0),m(C,null,q(o.categories,a=>(v(),m("div",Te,[t(J,{id:"category1",name:"category",value:a.id,modelValue:e.value.category,"onUpdate:modelValue":n=>e.value.category=n},null,8,["value","modelValue","onUpdate:modelValue"]),l("label",Ue,u(a.name),1)]))),256))])]),l("div",qe,[Re,t(K,{modelValue:e.value.tags,"onUpdate:modelValue":s[5]||(s[5]=a=>e.value.tags=a),options:o.tags,optionLabel:"name",placeholder:"Select Tags",filter:!0},{value:i(a=>[(v(!0),m(C,null,q(a.value,n=>(v(),m("div",{class:"inline-flex align-items-center py-1 px-2 bg-primary text-primary border-round mr-2",key:n.id},[l("div",null,u(n.name),1)]))),128)),!a.value||a.value.length===0?(v(),m("div",Le,"Select Tags")):S("",!0)]),_:1},8,["modelValue","options"])]),l("div",Be,[Ae,t(x,{modelValue:e.value.writer,"onUpdate:modelValue":s[6]||(s[6]=a=>e.value.writer=a),options:o.writers,optionLabel:"name",placeholder:"Select Writer"},null,8,["modelValue","options"])]),l("div",Ee,[Fe,t(x,{modelValue:e.value.publisher,"onUpdate:modelValue":s[7]||(s[7]=a=>e.value.publisher=a),options:o.publishers,optionLabel:"name",placeholder:"Select publisher"},null,8,["modelValue","options"])]),l("div",Oe,[$e,t(x,{modelValue:e.value.translator,"onUpdate:modelValue":s[8]||(s[8]=a=>e.value.translator=a),options:o.translators,optionLabel:"name",placeholder:"Select translator"},null,8,["modelValue","options"])])]),_:1},8,["visible"]),t(T,{visible:V.value,"onUpdate:visible":s[12]||(s[12]=a=>V.value=a),style:{width:"450px"},header:"Confirm",modal:!0},{footer:i(()=>[t(b,{label:"No",icon:"pi pi-times",class:"p-button-text",onClick:s[10]||(s[10]=a=>V.value=!1)}),t(b,{label:"Yes",icon:"pi pi-check",class:"p-button-text",onClick:s[11]||(s[11]=a=>F(e.value))})]),default:i(()=>[l("div",je,[Qe,e.value?(v(),m("span",We,[p("Are you sure you want to delete "),l("b",null,u(e.value.name),1),p("?")])):S("",!0)])]),_:1},8,["visible"])])])])]),_:1})],64)}}},Xe=X(Ge,[["__scopeId","data-v-73bae301"]]);export{Xe as default};