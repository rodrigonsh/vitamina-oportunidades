// databind
// Rodrigo Nishino <rodrigo.nsh@gmail.com>

let storedD = JSON.parse(localStorage.getItem("D"))
var D = ( storedD == null ) ? {} : storedD

function traverse(object, key, newValue)
{
	//if ( debug ) console.log(object, key, newValue)

	let partes = key.split(".")


	// TODO: check if numerical keys work
	if ( partes.length == 1 )
	{
		//check if is variable for a key elsewhere
		if ( key.startsWith("[") )
		{
			// strip [ & ]
			newKey = key.substring(1, key.length - 1 )
			key = traverse(D, newKey)
		}

		if ( undefined !== newValue )
		{
			object[ key ] = newValue
		}

		//console.log(object[ key ])

		return object[ key ]
	}

	else
	{

		var next = partes.shift()

		//console.log(next)

		//check if is variable for a key elsewhere
		if ( next.startsWith("[") )
		{

			// strip [ & ]
			newKey = next.substring(1, next.length - 1 )

			//console.log("it's a key variable", next)

			next = traverse(D, newKey)

			console.log(newKey, next)
		}

		//console.log(">> ", next)

		var deeper = object[ next ]
		var shorter = partes.join(".")

		return traverse(deeper, shorter, newValue)

	}
}

function databind()
{

  //console.log('dbind');

  $body.querySelectorAll("[data-bind]").forEach(function(el, i)
  {

    try
    {

		var tag = el.tagName

		// todo: traverse address with recursive function
		res = traverse(D, el.dataset.bind)

		//console.log( tag, el, res )
		twoWayTags = ['INPUT', 'ONS-INPUT', 'SELECT', 'TEXTAREA', 'ONS-SWITCH']

		if (  twoWayTags.indexOf(tag) > -1 && !el.hasAttribute("bound") )
		{

			el.setAttribute("bound", true)

			if ( tag == "SELECT" || tag == "ONS-SWITCH" || el.type == "checkbox")
			{
				el.addEventListener("change", databindOnChange)
			}
			else
			{
				el.addEventListener("keyup", databindOnChange)
			}

		}

		if ( undefined === res )
		{
		  el.setAttribute("undefined", true)
		  return
		}


		el.removeAttribute("undefined")
		el.removeAttribute("null")


		if ( tag == "IMG" )
		{
		  el.src = res
		}

		else if ( tag == "AUDIO" || tag == "VIDEO")
		{
		  el.src = res
		}

		else if ( tag == "A" )
		{
		  el.href = res
		}

		else if ( tag == "SWITCHER" )
		{

		  if( res == null ) el.removeAttribute("on")
		  else el.setAttribute("on", "on")

	  }

		else if ( tag == "ONS-SWITCH" || el.type == "checkbox" )
		{
			//console.log("HAUAHUA", el.dataset.bind , res)
			if( res == true )
			{
				el.setAttribute("checked", "checked")
				el.value = false
				//console.log("i should set the attribute to checked", el.getAttribute("checked"))
			}
			else
			{
				el.removeAttribute("checked")
				el.value = true
				//console.log("i should remove the checked attribute", el.hasAttribute("checked"))
			}
		}

		else if ( twoWayTags.indexOf(tag) > -1 )
		{
			el.value = res
		}

		else { el.textContent = res }

    }

    catch(err)
    {
		el.setAttribute("null", true)
    }


  });

  $body.querySelectorAll('[bind-placeholder]').forEach( function(el, i)
  {
    let res = traverse(D, el.getAttribute('bind-placeholder'))
    el.setAttribute('placeholder', res)
  });

}

function databindOnChange(ev)
{
	var t = ev.target
	var v = t.value
	let tag = t.tagName

	if (debug) console.log(v, tag, t.type)

	if ( tag == 'INPUT' )
	{
		t = getTarget(t, 'bind')
	}

	if ( tag == "ONS-SWITCH" || t.type == "checkbox")
	{

		test = t.hasAttribute("checked")

		if ( test )
		{
			v = false
			t.removeAttribute("checked")
		}
		else
		{
			v = true
			t.setAttribute("checked", "checked")
		}
	}

	var k = t.dataset.bind

	if (debug) console.log(tag, "CHANGED", t, k, v)

	var partes = k.split(".")
	var last = partes.pop()

	// TODO: auto set type to number?

	if ( last.startsWith("i_") )
	{
		traverse(D, k, parseInt(v))
	}

	else if ( last.startsWith("f_") )
	{
		traverse(D, k, parseFloat(v.replace(",", ".")))
	}

	else
	{
		traverse(D, k, v)
	}


	emit(k)

}
